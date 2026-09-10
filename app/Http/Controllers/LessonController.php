<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of lessons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::with('topic')
            ->orderBy('topic_id')
            ->orderBy('order', 'asc')
            ->paginate(10);
        return view('Pages.lessons', compact('lessons'));
    }

    /**
     * Show the form for creating a new lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::orderBy('topic_name')->get();
        return view('Pages.create_lesson', compact('topics'));
    }

    /**
     * Store a newly created lesson in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'topic_id' => 'required|exists:topics,id',
            'pdf' => 'required|file|mimes:pdf|max:20480', // max 20MB
            'order' => 'nullable|integer|min:1',
        ]);

        $topicId = $request->input('topic_id');
        $order = $request->input('order');

        if ($order !== null) {
            // Shift existing lessons with order >= $order in the same topic
            Lesson::where('topic_id', $topicId)->where('order', '>=', $order)->increment('order');
        } else {
            // Default value: order = last in topic
            $maxOrder = Lesson::where('topic_id', $topicId)->max('order');
            $order = ($maxOrder !== null) ? $maxOrder + 1 : 1;
        }

        // Store file using Laravel Storage (local disk, under lessons directory, not public)
        $pdfPath = $request->file('pdf')->store('lessons', 'local');

        $lesson = Lesson::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'topic_id' => $topicId,
            'pdf_path' => $pdfPath,
            'order' => $order,
            'is_published' => false,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lesson created successfully',
                'data' => $lesson
            ], 201);
        }

        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully');
    }

    /**
     * Show the form for editing the specified lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $topics = Topic::orderBy('topic_name')->get();
        return view('Pages.edit_lesson', compact('lesson', 'topics'));
    }

    /**
     * Update the specified lesson in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'topic_id' => 'required|exists:topics,id',
            'pdf' => 'nullable|file|mimes:pdf|max:20480', // max 20MB
            'order' => 'nullable|integer|min:1',
        ]);

        $oldTopicId = $lesson->topic_id;
        $newTopicId = $request->input('topic_id');
        $newOrder = $request->input('order');

        if ($newOrder !== null) {
            // If order value changed, or if topic changed and we want to place it at a specific order
            if ($newOrder != $lesson->order || $newTopicId != $oldTopicId) {
                Lesson::where('topic_id', $newTopicId)->where('order', '>=', $newOrder)->increment('order');
                $lesson->order = $newOrder;
            }
        } elseif ($newTopicId != $oldTopicId) {
            // Topic changed but no specific order provided, move to end of new topic
            $maxOrder = Lesson::where('topic_id', $newTopicId)->max('order');
            $lesson->order = ($maxOrder !== null) ? $maxOrder + 1 : 1;
        }

        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->topic_id = $newTopicId;

        if ($request->hasFile('pdf')) {
            // Delete old file
            if (Storage::disk('local')->exists($lesson->pdf_path)) {
                Storage::disk('local')->delete($lesson->pdf_path);
            }
            // Store new file
            $pdfPath = $request->file('pdf')->store('lessons', 'local');
            $lesson->pdf_path = $pdfPath;
        }

        $lesson->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lesson updated successfully',
                'data' => $lesson
            ], 200);
        }

        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully');
    }

    /**
     * Remove the specified lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);

        // Delete the PDF file from disk
        if (Storage::disk('local')->exists($lesson->pdf_path)) {
            Storage::disk('local')->delete($lesson->pdf_path);
        }

        // Delete lesson (progress deleted automatically by database cascade constraint)
        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully');
    }

    /**
     * Download/Stream the specified lesson PDF securely.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $lesson = Lesson::findOrFail($id);

        if (Storage::disk('local')->exists($lesson->pdf_path)) {
            return Storage::disk('local')->download($lesson->pdf_path, $lesson->title . '.pdf');
        }

        abort(404, 'File not found');
    }

    /**
     * Toggle the published status of a lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePublish($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->is_published = !$lesson->is_published;
        $lesson->save();

        return redirect()->back()->with('success', 'Lesson publishing status updated successfully');
    }

    /**
     * Display a listing of published lessons for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentIndex()
    {
        $lessons = Lesson::where('is_published', true)
            ->with('topic')
            ->orderBy('topic_id')
            ->orderBy('order', 'asc')
            ->paginate(10);
        return view('Pages.student_lessons', compact('lessons'));
    }

    /**
     * Move a lesson up in order within its topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveUp($id)
    {
        $lesson = Lesson::findOrFail($id);

        // Find the lesson immediately before this one in the same topic
        $previousLesson = Lesson::where('topic_id', $lesson->topic_id)
            ->where('order', '<', $lesson->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previousLesson) {
            $tempOrder = $lesson->order;
            $lesson->order = $previousLesson->order;
            $previousLesson->order = $tempOrder;

            $lesson->save();
            $previousLesson->save();
        }

        return redirect()->back()->with('success', 'Lesson order updated successfully');
    }

    /**
     * Move a lesson down in order within its topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveDown($id)
    {
        $lesson = Lesson::findOrFail($id);

        // Find the lesson immediately after this one in the same topic
        $nextLesson = Lesson::where('topic_id', $lesson->topic_id)
            ->where('order', '>', $lesson->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextLesson) {
            $tempOrder = $lesson->order;
            $lesson->order = $nextLesson->order;
            $nextLesson->order = $tempOrder;

            $lesson->save();
            $nextLesson->save();
        }

        return redirect()->back()->with('success', 'Lesson order updated successfully');
    }
}
