<!-- Offcanvas Component for Create Academy -->
<div class="offcanvas offcanvas-end" id="createAcademyOffcanvas" aria-labelledby="createAcademyOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 id="createAcademyOffcanvasLabel">Create Academy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('academies.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="academyName" class="form-label">Academy Name</label>
                <input type="text" class="form-control" id="academyName" name="academy_name" placeholder="Enter academy name">
            </div>
            <div class="mb-3">
                <label for="academyManager" class="form-label">Academy Manager</label>
                <select class="form-control" id="academyManager" name="manager_id">
                    <option value="">Select a Manager</option>
                    @foreach($allmanagers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->staff_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="academyDescription" class="form-label">Description</label>
                <textarea class="form-control" id="academyDescription" name="academy_description" rows="3" placeholder="Enter academy description"></textarea>
            </div>
            <div class="mb-3">
                <label for="academyLocation" class="form-label required">Academy Location</label>
                <input type="text" class="form-control required" id="academyLocation" name="academy_location" placeholder="Enter academy location" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
