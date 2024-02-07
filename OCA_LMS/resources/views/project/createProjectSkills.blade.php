@extends('layouts.app')
@section('title')
Create Project Skills
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Create Project Skills</a></li>

        </ul>
    </div>


</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage py-1 mt-5">
    <div class="container">
        <div class="addpro_skills">
            <h1 class="text-center mb-4">Create Project Skills</h1>
            <div class="projectSkill">
                <form>
                    <!-- Static values for skills and levels with descriptions -->
        @php
            $skills = [
                ['id' => 1, 'name' => 'Create mock-ups for an application'],
                ['id' => 2, 'name' => 'Create static and adaptive web user interfaces'],
                ['id' => 3, 'name' => 'Develop a dynamic web user interface'],
            ];

            $levels = [
                ['id' => 1, 'name' => 'Imitate'],
                ['id' => 2, 'name' => 'Adapt'],
                ['id' => 3, 'name' => 'Transpose'],
            ];

            $descriptions = [
                [ // Skill 1 descriptions
                    'Description for Imitate level on Create mock-ups for an application.',
                    'Description for Adapt level on Create mock-ups for an application.',
                    'Description for Transpose level on Create mock-ups for an application.'
                ],
                [ // Skill 2 descriptions
                    'Description for Imitate level on Create static and adaptive web user interfaces.',
                    'Description for Adapt level on Create static and adaptive web user interfaces.',
                    'Description for Transpose level on Create static and adaptive web user interfaces.'
                ],
                [ // Skill 3 descriptions
                    'Description for Imitate level on Develop a dynamic web user interface.',
                    'Description for Adapt level on Develop a dynamic web user interface.',
                    'Description for Transpose level on Develop a dynamic web user interface.'
                ],
            ];
        @endphp

                    @foreach($skills as $skill)
                        <div class="mb-3">
                            <label for="{{ 'skill_' . $skill['id'] }}" class="form-label">{{ $skill['name'] }}</label>
                            <select class="form-select" id="{{ 'skill_' . $skill['id'] }}" name="skills[{{ $skill['id'] }}]">
                                <option selected disabled>Select Level</option>
                                @foreach($levels as $index => $level)
                                    <option value="{{ $level['id'] }}" data-description="{{ $descriptions[$skill['id'] - 1][$index] }}">
                                        {{ $level['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <p style="color: green;" class="mt-2 level-description" id="{{ 'description_' . $skill['id'] }}"></p>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Save Project Skills Level</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
 // Add event listener to update the description when a level is selected
    document.addEventListener('DOMContentLoaded', function () {
        const selects = document.querySelectorAll('.form-select');
        selects.forEach(select => {
            select.addEventListener('change', function () {
                const descriptionId = 'description_' + this.id.split('_')[1];
                const selectedOption = this.options[this.selectedIndex];
                const descriptionElement = document.getElementById(descriptionId);
                descriptionElement.innerText = selectedOption.dataset.description;
            });
        });
    });
</script>


@endsection