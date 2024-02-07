<!-- resources/views/pages/announcements.blade.php -->
@extends('layouts.app')
@section('title')
Trainees Progress
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


@include('layouts.innerNav')
<section class="inner-bred my-5 ">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Trainees</a></li>

        </ul>
    </div>
</section>

<!-- Overview of the Trainees progress -->



<!------ Trainees Progress table ---------->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-primary">Trainees Progress General view</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget blank no-padding">
                <div class="panel panel-default work-progress-table">                    
                </div>
                <table id="mytable" class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall" /></th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Name
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Skill
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">S1 - Create mock-ups for an
                                            application</button>
                                        <button class="dropdown-item" type="button">S2 - Create static and adaptive web
                                            user interfaces</button>
                                        <button class="dropdown-item" type="button">S3 - Develop a dynamic web user
                                            interface</button>
                                        <button class="dropdown-item" type="button">S4 - Create a user interface with a
                                            content management</button>
                                        <button class="dropdown-item" type="button">S5 - Create a database</button>
                                        <button class="dropdown-item" type="button">S6 - Develop data access
                                            components</button>
                                        <button class="dropdown-item" type="button">S7 - Develop the back end</button>
                                        <button class="dropdown-item" type="button">S8 - Create and implement
                                            components</button>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Level
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">Level 1 - Imitate</button>
                                        <button class="dropdown-item" type="button">Level 2 - Adapt </button>
                                        <button class="dropdown-item" type="button">Level 3 - Transpose </button>
                                    </div>
                                </div>
                            </th>
                            <th style="width:50% ">Progress</th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Status
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">Pending</button>
                                        <button class="dropdown-item" type="button">Reviewed</button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Mohsin</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60"
                                        role="progressbar" class="red progress-bar">
                                        <span>60%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-info">Pending</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Haseeb</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 80%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80"
                                        role="progressbar" class="green progress-bar">
                                        <span>80%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-primary">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Hussain</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 40%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="purple progress-bar">
                                        <span>40%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed </span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Noman</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90"
                                        role="progressbar" class="purple progress-bar">
                                        <span>90%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-success">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Ubaid</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60"
                                        role="progressbar" class="red progress-bar">
                                        <span>60%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Adnan</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 45%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="45"
                                        role="progressbar" class="red progress-bar">
                                        <span>45%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Saboor</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <div class="progress">
                                    <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89"
                                        role="progressbar" class="green progress-bar">
                                        <span>89%</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="label label-warning">Reviewed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endSection