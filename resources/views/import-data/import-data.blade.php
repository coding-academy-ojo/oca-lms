@extends('layouts.app')

@section('title', 'Import Cohort Data')

@section('content')
@include('layouts.innerNav')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/orange-boosted/dist/css/orangeboosted.min.css">

<style>

.modal-header, .modal-body, .modal-footer {
    background-color: #f8f9fa !important;
    border-color: #dee2e6 !important;
}



.table-custom {
    width: 100%;
    border: 1px solid #dee2e6 !important;
}

.table-custom th, .table-custom td {
    border: 1px solid #dee2e6 !important;
    padding: 8px !important;
    text-align: left !important;
}
</style>

<div class="container my-4">
    <!-- Masterpiece Progress Section -->
    <div class="container my-4">
        <h2 class="mb-4 text-primary">Importing Data for {{ $cohort->cohort_name }}</h2>
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table verticle-middle table-responsive-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Table</th>
                                <th scope="col">Before importing</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Students Table</td>
                                <td>
                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#studentsInfoModal">Info</button>
                                </td>
                                <td>
                                    <span>
                                        <button class="mr-4 btn btn-primary" data-toggle="tooltip" data-placement="top"
                                            title="Import students" onclick="document.getElementById('import-file').click();">
                                            Import
                                        </button>
                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close"></a>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Soft Skills Trainings Table</td>
                                <td>
                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#softSkillsInfoModal">Info</button>
                                </td>
                                <td>
                                    <span>
                                        <button class="mr-4 btn btn-primary" data-toggle="tooltip" data-placement="top"
                                            title="Import soft skills trainings" onclick="document.getElementById('import-softskills-file').click();">
                                            Import
                                        </button>
                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close"></a>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Technologies Table</td>
                                <td>
                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#technologiesInfoModal">Info</button>
                                </td>
                                <td>
                                    <span>
                                        <button class="mr-4 btn btn-primary" data-toggle="tooltip" data-placement="top"
                                            title="Import technologies" onclick="document.getElementById('import-technologies-file').click();">
                                            Import
                                        </button>
                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close"></a>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Assignments Table</td>
                                <td>
                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#assignmentsInfoModal">Info</button>
                                </td>
                                <td>
                                    <span>
                                        <button class="mr-4 btn btn-primary" data-toggle="tooltip" data-placement="top"
                                            title="Import assignments" onclick="document.getElementById('import-assignments-file').click();">
                                            Import
                                        </button>
                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close"></a>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- Students Info Modal -->
   <div class="modal fade" id="studentsInfoModal" tabindex="-1" role="dialog" aria-labelledby="studentsInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title py-2 text-primary" id="studentsInfoModalLabel">Students Table Import Information</h5>
            </div>
            <div class="modal-body">
                <p>Please ensure your Excel file for students contains the following columns:</p>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Column</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>email</strong></td>
                            <td>The student's email address <span class="text-primary">(string, required)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>password</strong></td>
                            <td>The student's password <span class="text-primary">(string, required, min: 8 characters)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>is_newsletter</strong></td>
                            <td>Whether the student is subscribed to the newsletter <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>provider_id</strong></td>
                            <td>The provider ID of the student <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>email_verification</strong></td>
                            <td>The student's email verification status <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>is_email_verified</strong></td>
                            <td>Whether the student's email is verified <span class="text-primary">(0)</span> not virified<span class="text-primary">(1)</span> virified <span class="text-primary">(boolean, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>mobile</strong></td>
                            <td>The student's mobile number <span class="text-primary">(numeric, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>mobile_verification</strong></td>
                            <td>The student's mobile verification status <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>is_mobile_verified</strong></td>
                            <td>Whether the student's mobile is verified <span class="text-primary">(0)</span> not virified<span class="text-primary">(1)</span> virified <span class="text-primary">(boolean, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>nationality</strong></td>
                            <td>The student's nationality <span class="text-primary">(integer, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>country</strong></td>
                            <td>The student's country <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>passport_number</strong></td>
                            <td>The student's passport number <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>national_id</strong></td>
                            <td>The student's national ID <span class="text-primary">(integer, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>birthdate</strong></td>
                            <td>The student's birthdate <span class="text-primary">(date, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>en_first_name</strong></td>
                            <td>The student's first name in English <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>en_second_name</strong></td>
                            <td>The student's second name in English <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>en_third_name</strong></td>
                            <td>The student's third name in English <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>en_last_name</strong></td>
                            <td>The student's last name in English <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>ar_first_name</strong></td>
                            <td>The student's first name in Arabic <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>ar_second_name</strong></td>
                            <td>The student's second name in Arabic <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>ar_third_name</strong></td>
                            <td>The student's third name in Arabic <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>ar_last_name</strong></td>
                            <td>The student's last name in Arabic <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>gender</strong></td>
                            <td>The student's gender <span class="text-primary">(string, optional, values: male, female, other)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>martial_status</strong></td>
                            <td>The student's marital status <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>remember_token</strong></td>
                            <td>The student's remember token <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>education</strong></td>
                            <td>The student's education level <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>educational_status</strong></td>
                            <td>The student's current educational status <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>field</strong></td>
                            <td>The student's field of study <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>educational_background</strong></td>
                            <td>The student's educational background <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>ar_writing</strong></td>
                            <td>The student's Arabic writing proficiency <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>ar_speaking</strong></td>
                            <td>The student's Arabic speaking proficiency <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>en_writing</strong></td>
                            <td>The student's English writing proficiency <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>en_speaking</strong></td>
                            <td>The student's English speaking proficiency <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>city</strong></td>
                            <td>The student's city of residence <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>address</strong></td>
                            <td>The student's address <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>relative_mobile_1</strong></td>
                            <td>The first relative's mobile number <span class="text-primary">(numeric, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>relative_relation_1</strong></td>
                            <td>The first relative's relationship <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>fullName_1</strong></td>
                            <td>The full name of the first relative <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>relative_mobile_2</strong></td>
                            <td>The second relative's mobile number <span class="text-primary">(numeric, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>relative_relation_2</strong></td>
                            <td>The second relative's relationship <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>fullName_2</strong></td>
                            <td>The full name of the second relative <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>is_committed</strong></td>
                            <td>Whether the student is committed <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>is_submitted</strong></td>
                            <td>Whether the student's data is submitted <span class="text-primary">(0)</span> not submitted<span class="text-primary">(1)</span> submitted <span class="text-primary"> (boolean, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>status</strong></td>
                            <td>The student's current status <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>result_1</strong></td>
                            <td>The student's first result <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>academy_location</strong></td>
                            <td>The academy location <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        {{-- <tr>
                            <td><strong>id_img</strong></td>
                            <td>The ID image <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>personal_img</strong></td>
                            <td>The personal image <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>vaccination_img</strong></td>
                            <td>The vaccination image <span class="text-primary">(string, optional)</span>.</td>
                        </tr> --}}
                        <tr>
                            <td><strong>eligible_to_move</strong></td>
                            <td>Whether the student is eligible to move <span class="text-primary">(string, optional)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>github_link</strong></td>
                            <td>The student's GitHub profile link <span class="text-primary">(string, optional, URL)</span>.</td>
                        </tr>
                        <tr>
                            <td><strong>linkedin_link</strong></td>
                            <td>The student's LinkedIn profile link <span class="text-primary">(string, optional, URL)</span>.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
<!-- Soft Skills Info Modal -->
    <div class="modal fade" id="softSkillsInfoModal" tabindex="-1" role="dialog" aria-labelledby="softSkillsInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title py-2 text-primary" id="softSkillsInfoModalLabel">Soft Skills Trainings Table Import Information</h5>
                    
                </div>
                <div class="modal-body">
                    <p>Please ensure your Excel file for soft skills trainings contains the following columns:</p>
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Column</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>name</strong></td>
                                <td>The name of the training <span class="text-primary">(required)</span>.</td>
                            </tr>
                            <tr>
                                <td><strong>description</strong></td>
                                <td>A description of the training <span class="text-primary">(required)</span>.</td>
                            </tr>
                            <tr>
                                <td><strong>trainer</strong></td>
                                <td>The name of the trainer <span class="text-primary">(required)</span>.</td>
                            </tr>
                            <tr>
                                <td><strong>date</strong></td>
                                <td>The date of the training in <em>YYYY-MM-DD</em> format <span class="text-primary">(required)</span>.</td>
                            </tr>
                            <tr>
                                <td><strong>satisfaction</strong></td>
                                <td>The satisfaction <span class="text-primary">integer</span> rating of the training (0-5) <span class="text-primary">(required)</span>.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Technologies Info Modal -->
<div class="modal fade" id="technologiesInfoModal" tabindex="-1" role="dialog" aria-labelledby="technologiesInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title py-2 text-primary" id="technologiesInfoModalLabel">Technologies Table Import Information</h5>
            </div>
            <div class="modal-body">
                @if ($tech_category->isEmpty())
                    <p class="font-weight-bold">No technology categories available.</p>
                @else
                    <p class="py-1">Technology Category ID</p>
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tech_category as $tech)
                            <tr>
                                <td><strong>{{ $tech->Categories_name }}</strong></td>
                                <td><span class="text-primary">{{ $tech->id }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <p class="py-2">Please ensure your Excel file for technologies contains the following columns:</p>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Column</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>technology_category_id</strong></td>
                            <td>The ID of the technology category <span class="text-primary">(integer, required)</span>. This should be a valid category ID that exists in your system.</td>
                        </tr>
                        <tr>
                            <td><strong>technologies_name</strong></td>
                            <td>The name of the technology <span class="text-primary">(string, required)</span>. Provide a unique and descriptive name for the technology.</td>
                        </tr>
                        <tr>
                            <td><strong>technologies_description</strong></td>
                            <td>A detailed description of the technology <span class="text-primary">(string, required)</span>. Explain what the technology is and its purpose.</td>
                        </tr>
                        <tr>
                            <td><strong>technologies_resources</strong></td>
                            <td>Resources related to the technology <span class="text-primary">(string, required)</span>. This could include <span class="text-primary">links OR text</span> to documentation, tutorials, or other relevant resources.</td>
                        </tr>
                        <tr>
                            <td><strong>technologies_trainingperiod</strong></td>
                            <td>The training period required to learn the technology <span class="text-primary">(string, required)</span>. Specify the duration and format (e.g., "3 months, online").</td>
                        </tr>
                        <tr>
                            <td><strong>technologies_photo</strong></td>
                            <td>A <span class="text-primary">URL</span> or path to a photo representing the technology <span class="text-primary">(string, optional)</span>. This can be used for visual identification.</td>
                        </tr>
                        <tr>
                            <td><strong>start_date</strong></td>
                            <td>The start date of the technology training in the cohort <span class="text-primary">(date, optional, format: YYYY-MM-DD)</span>. Leave blank if the training has no specific start date.</td>
                        </tr>
                        <tr>
                            <td><strong>end_date</strong></td>
                            <td>The end date of the technology training in the cohort <span class="text-primary">(date, optional, format: YYYY-MM-DD)</span>. Leave blank if the training has no specific end date.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Assignments Info Modal -->
<div class="modal fade" id="assignmentsInfoModal" tabindex="-1" role="dialog" aria-labelledby="assignmentsInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title py-2 text-primary" id="assignmentsInfoModalLabel">Assignments Table Import Information</h5>
            </div>
            <div class="modal-body">
                @if ($topics->isEmpty())
                <p class="font-weight-bold">No topics available.</p>
            @else
                <p class="py-1">Topics</p>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topics as $topic)
                        <tr>
                            <td><strong>{{ $topic->topic_name }}</strong></td>
                            <td><span class="text-primary">{{ $topic->id }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
                <p class="py-2">Please ensure your Excel file for assignments contains the following columns:</p>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Column</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>assignment_name</strong></td>
                            <td>The name of the assignment <span class="text-primary">(string, required)</span>. Provide a descriptive name for the assignment.</td>
                        </tr>
                        <tr>
                            <td><strong>assignment_description</strong></td>
                            <td>A detailed description of the assignment <span class="text-primary">(string, optional)</span>. Provide additional information about the assignment if needed.</td>
                        </tr>
                        <tr>
                            <td><strong>assignment_level</strong></td>
                            <td>The level of the assignment <span class="text-primary">(string: 'easy', 'medium', or 'advance', required)</span>. Specify the difficulty level of the assignment.</td>
                        </tr>
                        <tr>
                            <td><strong>assignment_due_date</strong></td>
                            <td>The due date of the assignment <span class="text-primary">(date, required, format: YYYY-MM-DD)</span>. Specify the deadline for completing the assignment.</td>
                        </tr>
                        <tr>
                            <td><strong>assignment_attached_file</strong></td>
                            <td>A <span class="text-primary">URL</span> or path to the attached file <span class="text-primary">(string, optional)</span>. Attach any relevant files/documents related to the assignment.</td>
                        </tr>
                        <tr>
                            <td><strong>topic_id</strong></td>
                            <td>The ID of the topic associated with the assignment <span class="text-primary">(integer, required)</span>. This should be a valid topic ID that exists in your system.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Import form for Technologies -->
<form action="{{ route('import-data.import-technologies', $cohort->id) }}" method="POST" enctype="multipart/form-data" style="display:none;">
    @csrf
    <input type="file" name="file" id="import-technologies-file" onchange="this.form.submit()">
</form>

    <form action="{{ route('import-data.import', $cohort->id) }}" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        <input type="file" name="file" id="import-file" onchange="this.form.submit()">
    </form>
    <form action="{{ route('import-data.import-softskills', $cohort->id) }}" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        <input type="file" name="file" id="import-softskills-file" onchange="this.form.submit()">
    </form>
    <form action="{{ route('import-data.import-assignments', $cohort->id) }}" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        <input type="file" name="file" id="import-assignments-file" onchange="this.form.submit()">
    </form>
    
</div>

@endsection
