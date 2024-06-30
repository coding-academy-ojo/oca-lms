<div class="offcanvas offcanvas-end" tabindex="-1" id="addCohortOffcanvas" aria-labelledby="addCohortOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 id="addCohortOffcanvasLabel">Add Cohort</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="addCohortForm" action="{{ route('store-cohort') }}" method="POST">
            @csrf
            <input type="hidden" name="academy_id" id="hiddenAcademyId" value="">
            <div class="mb-3">
                <label for="cohortName" class="form-label">Cohort Name</label>
                <input type="text" class="form-control" id="cohortName" name="cohort_name" required>
            </div>
            <div class="mb-3">
                <label for="cohortDonor" class="form-label">Cohort Donor</label>
                <input type="text" class="form-control" id="cohortDonor" name="cohort_donor" required>
            </div>
            <div class="mb-3">
                <label for="cohortDescription" class="form-label">Description</label>
                <textarea class="form-control" id="cohortDescription" name="cohort_description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="cohortStartDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="cohortStartDate" name="cohort_start_date" required>
            </div>
            <div class="mb-3">
                <label for="cohortEndDate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="cohortEndDate" name="cohort_end_date" required>
            </div>
            
            @if ($trainers->count() > 0)
            <div class="mb-3">
                <label class="form-label">Trainers</label>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" style="width: 100%; border-radius: 0; text-align: left;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Choose Trainers
                    </button>
                    <div class="dropdown-menu p-2 form-select" aria-labelledby="dropdownMenuButton">
                        @foreach ($trainers as $trainer)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="trainers[]" value="{{ $trainer->id }}" id="trainer{{ $trainer->id }}" @if(in_array($trainer->id, $cohort->staff->pluck('id')->toArray())) checked @endif>
                            <label class="form-check-label" for="trainer{{ $trainer->id }}">
                                {{ $trainer->staff_name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Add Cohort</button>
        </form>
    </div>
</div>
