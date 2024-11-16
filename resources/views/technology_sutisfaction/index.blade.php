@extends('Layouts.app')

@section('title', 'Technology Overview')

@section('content')
    @include('Layouts.innerNav')

    <div class="container mt-5" style="min-height: 50vh">
        <h2 class="mb-4 text-primary">Technology Overview for Cohort</h2>

        @if (empty($technologiesOverview))
            <p>No technology data available for this cohort.</p>
        @else
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">Training Period</th>
                                <th scope="col">Progress (%)</th>
                                <th scope="col">Satisfaction Rate (%)</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($technologiesOverview) === 0)
                                <tr>
                                    <td colspan="8">No technologies added yet</td>
                                </tr>
                            @else
                                @foreach($technologiesOverview as $index => $technology)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $technology['name'] }}</td>
                                        <td>{{ $technology['start_date'] }}</td>
                                        <td>{{ $technology['training_period'] }}</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $technology['percentage'] }}%; background-color: {{ $technology['percentage'] < 80 ? '#FFD700' : '#499557' }};">
                                                    {{ $technology['percentage'] }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $technology['satisfaction_rate'] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                onclick="openEditSatisfactionModal({{ $technology['id'] }}, {{ json_encode($technology['satisfaction_rate'] ?? 0) }}, {{ $cohort->id }})">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                
            </div>
        @endif
    </div>

    <!-- Edit Satisfaction Modal -->
    <div class="modal fade" id="editSatisfactionModal" tabindex="-1" aria-labelledby="editSatisfactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSatisfactionModalLabel">Edit Satisfaction Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSatisfactionForm" action="{{ route('update-satisfaction') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="technology_id" id="technologyId">
                        <input type="hidden" name="cohort_id" id="cohortId" value="{{ $cohort->id }}"> <!-- Ensure this is set correctly -->
                        <!-- Added hidden input for cohort_id -->
                        <div class="mb-3">
                            <label for="editSatisfaction" class="form-label">Satisfaction Rate (%)</label>
                            <input type="range" class="form-range" id="editSatisfaction" name="satisfaction"
                                min="0" max="100" step="1"
                                oninput="updateSatisfactionDisplay(this.value)">
                            <div class="d-flex justify-content-between">
                                <small>0%</small>
                                <small>100%</small>
                            </div>
                            <input type="text" id="editSatisfactionDisplay" class="form-control mt-2" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<style>
    .modal-body {

    padding: 20px !important;
}
.modal-header {
    padding: 16px !important;
}
</style>
    <script>
        // Function to update the display value for satisfaction
        function updateSatisfactionDisplay(value) {
            document.getElementById('editSatisfactionDisplay').value = value + '%';
        }

        function openEditSatisfactionModal(technologyId, currentSatisfaction, cohortId) {
            document.getElementById('technologyId').value = technologyId;
            document.getElementById('cohortId').value = cohortId; // Populate the cohortId input
            document.getElementById('editSatisfaction').value = currentSatisfaction;
            updateSatisfactionDisplay(currentSatisfaction);
            var editSatisfactionModal = new bootstrap.Modal(document.getElementById('editSatisfactionModal'));
            editSatisfactionModal.show();
        }
    </script>

@endsection
