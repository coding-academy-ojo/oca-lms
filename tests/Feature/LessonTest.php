<?php

namespace Tests\Feature;

use App\Academy;
use App\Cohort;
use App\Lesson;
use App\Progress;
use App\Staff;
use App\Student;
use App\Technology;
use App\TechnologyCategory;
use App\Technology_Cohort;
use App\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

    protected $trainer;
    protected $student;
    protected $topic;

    protected function setUp(): void
    {
        parent::setUp();

        // Setup base entities
        $academy = Academy::create([
            'academy_name' => 'Amman Academy',
            'academy_location' => 'Amman',
        ]);

        $cohort = Cohort::create([
            'cohort_name' => 'Cohort 1',
            'cohort_description' => 'Description',
            'cohort_start_date' => '2026-01-01',
            'cohort_end_date' => '2026-06-30',
            'cohort_donor' => 'Donor',
            'academy_id' => $academy->id,
        ]);

        $this->trainer = Staff::create([
            'staff_name' => 'Trainer User',
            'staff_email' => 'trainer@test.com',
            'staff_password' => bcrypt('password'),
            'role' => 'trainer',
        ]);

        $this->student = Student::create([
            'email' => 'student@test.com',
            'password' => bcrypt('password'),
            'academy_id' => $academy->id,
            'cohort_id' => $cohort->id,
        ]);

        $category = TechnologyCategory::create([
            'Categories_name' => 'Web Development'
        ]);

        $technology = Technology::create([
            'technology_category_id' => $category->id,
            'technologies_name' => 'PHP',
            'technologies_description' => 'PHP Language',
            'technologies_resources' => 'PHP resources',
            'technologies_trainingPeriod' => '2 weeks',
        ]);

        $techCohort = Technology_Cohort::create([
            'technology_id' => $technology->id,
        ]);

        $this->topic = Topic::create([
            'topic_name' => 'Eloquent ORM',
            'technology_cohort_id' => $techCohort->id,
        ]);

        // Fake the local filesystem
        Storage::fake('local');
    }

    /** @test */
    public function test_relationships_are_correctly_defined()
    {
        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Introduction to Eloquent',
            'description' => 'Basic lesson',
            'pdf_path' => 'lessons/sample.pdf',
            'order' => 1,
            'is_published' => true,
        ]);

        $progress = Progress::create([
            'student_id' => $this->student->id,
            'lesson_id' => $lesson->id,
            'completed_at' => now(),
        ]);

        // 1. Topic hasMany Lessons
        $this->assertTrue($this->topic->lessons->contains($lesson));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->topic->lessons);

        // 2. Lesson belongsTo Topic
        $this->assertEquals($this->topic->id, $lesson->topic->id);
        $this->assertInstanceOf(Topic::class, $lesson->topic);

        // 3. Lesson hasMany Progress
        $this->assertTrue($lesson->progress->contains($progress));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $lesson->progress);

        // 4. Progress belongsTo Student
        $this->assertEquals($this->student->id, $progress->student->id);
        $this->assertInstanceOf(Student::class, $progress->student);

        // 5. Progress belongsTo Lesson
        $this->assertEquals($lesson->id, $progress->lesson->id);
        $this->assertInstanceOf(Lesson::class, $progress->lesson);

        // 6. Student belongsToMany Lessons (via progress)
        $this->assertTrue($this->student->lessons->contains($lesson));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->student->lessons);

        // 7. Student hasMany Progress records
        $this->assertTrue($this->student->lessonProgress->contains($progress));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->student->lessonProgress);

        // 8. Lesson belongsToMany Students (via progress)
        $this->assertTrue($lesson->students->contains($this->student));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $lesson->students);
    }

    /** @test */
    public function test_guest_cannot_store_lesson()
    {
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $response = $this->post('/lessons', [
            'title' => 'Guest Lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
        ]);

        $response->assertRedirect('/login');
        $this->assertEquals(0, Lesson::count());
    }

    /** @test */
    public function test_student_cannot_store_lesson()
    {
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        // Login as student
        Auth::guard('students')->login($this->student);

        $response = $this->post('/lessons', [
            'title' => 'Student Lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
        ]);

        $response->assertRedirect('/');
        $this->assertEquals(0, Lesson::count());
    }

    /** @test */
    public function test_trainer_can_store_lesson_with_valid_data()
    {
        // Login as trainer (staff guard)
        Auth::guard('staff')->login($this->trainer);

        $file = UploadedFile::fake()->create('document.pdf', 5000); // 5MB

        $response = $this->post('/lessons', [
            'title' => 'First Lesson',
            'description' => 'Awesome description of first lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
        ]);

        $response->assertRedirect();
        
        $this->assertEquals(1, Lesson::count());

        $lesson = Lesson::first();
        $this->assertEquals('First Lesson', $lesson->title);
        $this->assertEquals('Awesome description of first lesson', $lesson->description);
        $this->assertEquals($this->topic->id, $lesson->topic_id);
        $this->assertFalse((bool)$lesson->is_published);
        $this->assertEquals(1, $lesson->order);

        // Assert file exists on 'local' disk
        Storage::disk('local')->assertExists($lesson->pdf_path);
    }

    /** @test */
    public function test_store_lesson_orders_correctly_as_last_in_topic()
    {
        Auth::guard('staff')->login($this->trainer);

        // Create first lesson manually
        Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson 1',
            'pdf_path' => 'lessons/l1.pdf',
            'order' => 5,
        ]);

        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $response = $this->post('/lessons', [
            'title' => 'Lesson 2',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
        ]);

        $response->assertRedirect();
        
        // Order of the new lesson should be max(5) + 1 = 6
        $lesson2 = Lesson::where('title', 'Lesson 2')->first();
        $this->assertEquals(6, $lesson2->order);
    }

    /** @test */
    public function test_store_lesson_validates_required_fields()
    {
        Auth::guard('staff')->login($this->trainer);

        $response = $this->post('/lessons', [], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'topic_id', 'pdf']);
    }

    /** @test */
    public function test_store_lesson_validates_pdf_only()
    {
        Auth::guard('staff')->login($this->trainer);

        $file = UploadedFile::fake()->create('document.txt', 1000); // TXT file

        $response = $this->post('/lessons', [
            'title' => 'Text Lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['pdf']);
    }

    /** @test */
    public function test_store_lesson_validates_pdf_max_size()
    {
        Auth::guard('staff')->login($this->trainer);

        $file = UploadedFile::fake()->create('document.pdf', 25000); // 25MB (max is 20MB)

        $response = $this->post('/lessons', [
            'title' => 'Huge Lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['pdf']);
    }

    /** @test */
    public function test_trainer_can_access_create_lesson_page()
    {
        Auth::guard('staff')->login($this->trainer);

        $response = $this->get('/lessons/create');

        $response->assertStatus(200);
        $response->assertViewIs('Pages.create_lesson');
        $response->assertViewHas('topics');
    }

    /** @test */
    public function test_guest_cannot_access_create_lesson_page()
    {
        $response = $this->get('/lessons/create');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_student_cannot_access_create_lesson_page()
    {
        Auth::guard('students')->login($this->student);

        $response = $this->get('/lessons/create');

        $response->assertRedirect('/');
    }

    /** @test */
    public function test_trainer_can_access_lessons_index_page()
    {
        Auth::guard('staff')->login($this->trainer);

        $response = $this->get('/lessons');

        $response->assertStatus(200);
        $response->assertViewIs('Pages.lessons');
        $response->assertViewHas('lessons');
    }

    /** @test */
    public function test_trainer_can_access_edit_lesson_page()
    {
        Auth::guard('staff')->login($this->trainer);

        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson to edit',
            'pdf_path' => 'lessons/sample.pdf',
        ]);

        $response = $this->get("/lessons/{$lesson->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('Pages.edit_lesson');
        $response->assertViewHas('lesson');
        $response->assertViewHas('topics');
    }

    /** @test */
    public function test_trainer_can_update_lesson_metadata_only()
    {
        Auth::guard('staff')->login($this->trainer);

        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Old Title',
            'description' => 'Old Description',
            'pdf_path' => 'lessons/sample.pdf',
        ]);

        $response = $this->put("/lessons/{$lesson->id}", [
            'title' => 'New Title',
            'description' => 'New Description',
            'topic_id' => $this->topic->id,
        ]);

        $response->assertRedirect('/lessons');
        $lesson->refresh();
        $this->assertEquals('New Title', $lesson->title);
        $this->assertEquals('New Description', $lesson->description);
        $this->assertEquals('lessons/sample.pdf', $lesson->pdf_path);
    }

    /** @test */
    public function test_trainer_can_update_lesson_with_new_pdf_deleting_old_one()
    {
        Auth::guard('staff')->login($this->trainer);

        Storage::disk('local')->put('lessons/old.pdf', 'old pdf content');

        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Old Title',
            'pdf_path' => 'lessons/old.pdf',
        ]);

        Storage::disk('local')->assertExists('lessons/old.pdf');

        $newFile = UploadedFile::fake()->create('new_document.pdf', 1000);

        $response = $this->put("/lessons/{$lesson->id}", [
            'title' => 'Updated Lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $newFile,
        ]);

        $response->assertRedirect('/lessons');
        $lesson->refresh();

        Storage::disk('local')->assertMissing('lessons/old.pdf');
        Storage::disk('local')->assertExists($lesson->pdf_path);
        $this->assertNotEquals('lessons/old.pdf', $lesson->pdf_path);
    }

    /** @test */
    public function test_trainer_can_delete_lesson_with_pdf_deleting()
    {
        Auth::guard('staff')->login($this->trainer);

        Storage::disk('local')->put('lessons/to_delete.pdf', 'delete me');

        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson to delete',
            'pdf_path' => 'lessons/to_delete.pdf',
        ]);

        Storage::disk('local')->assertExists('lessons/to_delete.pdf');

        $progress = Progress::create([
            'student_id' => $this->student->id,
            'lesson_id' => $lesson->id,
        ]);

        $response = $this->delete("/lessons/{$lesson->id}");

        $response->assertRedirect('/lessons');
        
        $this->assertEquals(0, Lesson::count());
        $this->assertEquals(0, Progress::count());

        Storage::disk('local')->assertMissing('lessons/to_delete.pdf');
    }

    /** @test */
    public function test_authorized_users_can_download_lesson_pdf()
    {
        Storage::disk('local')->put('lessons/downloadable.pdf', 'file content');

        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Downloadable Lesson',
            'pdf_path' => 'lessons/downloadable.pdf',
        ]);

        Auth::guard('staff')->login($this->trainer);
        $responseTrainer = $this->get("/lessons/{$lesson->id}/download");
        $responseTrainer->assertStatus(200);
        $responseTrainer->assertHeader('content-disposition', 'attachment; filename="Downloadable Lesson.pdf"');

        Auth::guard('students')->login($this->student);
        $responseStudent = $this->get("/lessons/{$lesson->id}/download");
        $responseStudent->assertStatus(200);
        $responseStudent->assertHeader('content-disposition', 'attachment; filename="Downloadable Lesson.pdf"');
    }

    /** @test */
    public function test_trainer_can_toggle_lesson_publish_status()
    {
        Auth::guard('staff')->login($this->trainer);

        $lesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Toggle Lesson',
            'pdf_path' => 'lessons/sample.pdf',
            'is_published' => false,
        ]);

        $response = $this->patch("/lessons/{$lesson->id}/toggle-publish");

        $response->assertRedirect();
        $lesson->refresh();
        $this->assertTrue((bool)$lesson->is_published);

        $this->patch("/lessons/{$lesson->id}/toggle-publish");
        $lesson->refresh();
        $this->assertFalse((bool)$lesson->is_published);
    }

    /** @test */
    public function test_student_lessons_view_shows_only_published_lessons()
    {
        $publishedLesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Published Lesson',
            'pdf_path' => 'lessons/p.pdf',
            'is_published' => true,
        ]);

        $draftLesson = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Draft Lesson',
            'pdf_path' => 'lessons/d.pdf',
            'is_published' => false,
        ]);

        Auth::guard('students')->login($this->student);

        $response = $this->get('/Student/Lessons');

        $response->assertStatus(200);
        $response->assertViewIs('Pages.student_lessons');
        $response->assertViewHas('lessons');
        
        $lessons = $response->viewData('lessons');
        $this->assertTrue($lessons->contains($publishedLesson));
        $this->assertFalse($lessons->contains($draftLesson));
    }

    /** @test */
    public function test_student_cannot_access_lessons_crud_routes()
    {
        Auth::guard('students')->login($this->student);

        $this->get('/lessons')->assertRedirect('/');
        $this->get('/lessons/1/edit')->assertRedirect('/');
    }

    /** @test */
    public function test_trainer_cannot_access_student_lessons_route()
    {
        Auth::guard('staff')->login($this->trainer);

        $this->get('/Student/Lessons')->assertRedirect('/');
    }

    /** @test */
    public function test_trainer_can_move_lesson_up()
    {
        Auth::guard('staff')->login($this->trainer);

        $lessonA = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson A',
            'pdf_path' => 'lessons/a.pdf',
            'order' => 1,
        ]);

        $lessonB = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson B',
            'pdf_path' => 'lessons/b.pdf',
            'order' => 2,
        ]);

        $response = $this->post("/lessons/{$lessonB->id}/move-up");

        $response->assertRedirect();
        
        $lessonA->refresh();
        $lessonB->refresh();

        $this->assertEquals(2, $lessonA->order);
        $this->assertEquals(1, $lessonB->order);
    }

    /** @test */
    public function test_trainer_can_move_lesson_down()
    {
        Auth::guard('staff')->login($this->trainer);

        $lessonA = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson A',
            'pdf_path' => 'lessons/a.pdf',
            'order' => 1,
        ]);

        $lessonB = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson B',
            'pdf_path' => 'lessons/b.pdf',
            'order' => 2,
        ]);

        $response = $this->post("/lessons/{$lessonA->id}/move-down");

        $response->assertRedirect();
        
        $lessonA->refresh();
        $lessonB->refresh();

        $this->assertEquals(2, $lessonA->order);
        $this->assertEquals(1, $lessonB->order);
    }

    /** @test */
    public function test_store_lesson_with_custom_order_shifts_subsequent_lessons()
    {
        Auth::guard('staff')->login($this->trainer);

        $lessonA = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson A',
            'pdf_path' => 'lessons/a.pdf',
            'order' => 1,
        ]);

        $lessonB = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson B',
            'pdf_path' => 'lessons/b.pdf',
            'order' => 2,
        ]);

        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $response = $this->post('/lessons', [
            'title' => 'New Lesson',
            'topic_id' => $this->topic->id,
            'pdf' => $file,
            'order' => 2,
        ]);

        $response->assertRedirect();

        $lessonA->refresh();
        $lessonB->refresh();
        $newLesson = Lesson::where('title', 'New Lesson')->first();

        $this->assertEquals(1, $lessonA->order);
        $this->assertEquals(2, $newLesson->order);
        $this->assertEquals(3, $lessonB->order);
    }

    /** @test */
    public function test_update_lesson_with_custom_order_shifts_subsequent_lessons()
    {
        Auth::guard('staff')->login($this->trainer);

        $lessonA = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson A',
            'pdf_path' => 'lessons/a.pdf',
            'order' => 1,
        ]);

        $lessonB = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson B',
            'pdf_path' => 'lessons/b.pdf',
            'order' => 2,
        ]);

        $lessonC = Lesson::create([
            'topic_id' => $this->topic->id,
            'title' => 'Lesson C',
            'pdf_path' => 'lessons/c.pdf',
            'order' => 3,
        ]);

        $response = $this->put("/lessons/{$lessonC->id}", [
            'title' => 'Lesson C Updated',
            'topic_id' => $this->topic->id,
            'order' => 2,
        ]);

        $response->assertRedirect();

        $lessonA->refresh();
        $lessonB->refresh();
        $lessonC->refresh();

        $this->assertEquals(1, $lessonA->order);
        $this->assertEquals(2, $lessonC->order);
        $this->assertEquals(3, $lessonB->order);
    }
}

