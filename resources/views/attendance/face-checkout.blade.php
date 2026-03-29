@extends('Layouts.app')

@section('title', 'Face Check-out - OCA LMS')

@section('content')
<style>
    .camera-container {
        position: relative;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    #video, #verificationVideo {
        width: 100%;
        border-radius: 12px;
        display: block;
    }

    .checkout-card {
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .face-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ff7900;
    }

    .verification-result {
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        margin-top: 20px;
    }

    .verification-success {
        background: #d4edda;
        border: 2px solid #28a745;
    }

    .verification-fail {
        background: #f8d7da;
        border: 2px solid #dc3545;
    }

    .location-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .location-badge.getting { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
    .location-badge.success { background: #d4edda; color: #155724; border: 1px solid #28a745; }
    .location-badge.error   { background: #f8d7da; color: #721c24; border: 1px solid #dc3545; }

    .info-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
        text-align: left;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
    }

    .info-value {
        color: #212529;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card checkout-card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">📸 Face Check-out</h4>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Enter your Student ID and verify your face to check out</p>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Academy</label>
                            <select class="form-select" id="academySelect">
                                <option value="">All Academies</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cohort</label>
                            <select class="form-select" id="cohortSelect">
                                <option value="">All Cohorts</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Student ID</label>
                            <input type="number" class="form-control" id="studentId" placeholder="Enter your student ID">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="verificationType" id="faceVerify" value="face" checked>
                            <label class="form-check-label" for="faceVerify">Face Recognition</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="verificationType" id="idVerify" value="id">
                            <label class="form-check-label" for="idVerify">Manual ID</label>
                        </div>
                    </div>

                    <div class="camera-container mb-3" id="cameraContainer" style="display: none;">
                        <video id="verificationVideo" autoplay playsinline></video>
                    </div>

                    <div id="enrolledPhoto" class="mb-3" style="display: none;">
                        <p class="text-muted small">Your enrolled photo:</p>
                        <img id="enrolledPhotoImg" class="face-preview" alt="Enrolled photo">
                    </div>

                    <!-- Location Status -->
                    <div class="mb-3">
                        <span id="locationBadge" class="location-badge getting">
                            📍 Getting your location...
                        </span>
                    </div>

                    <div id="verificationResult"></div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" id="startVerifyBtn" onclick="startVerification()">
                            📷 Start Camera
                        </button>
                        <button class="btn btn-success" id="verifyBtn" onclick="verifyFace()" disabled>
                            ✅ Verify & Check Out
                        </button>
                        <button class="btn btn-warning" id="manualCheckoutBtn" onclick="manualCheckout()" style="display: none;">
                            ✓ Check Out with ID
                        </button>
                        <button class="btn btn-secondary" id="stopVerifyBtn" onclick="stopVerification()" style="display: none;">
                            Stop Camera
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="/attendance/checkin" class="text-muted small">Go to Check-in Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
<script>
    let video, stream, currentStudentDescriptor = null;
    let modelsLoaded = false;
    let userLatitude = null, userLongitude = null;

    $(document).ready(function() {
        loadModels();
        loadAcademiesForCheckout();
        video = document.getElementById('verificationVideo');

        // Get GPS location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    userLatitude  = pos.coords.latitude;
                    userLongitude = pos.coords.longitude;
                    $('#locationBadge')
                        .removeClass('getting error')
                        .addClass('success')
                        .html('✅ Location acquired');
                },
                function() {
                    $('#locationBadge')
                        .removeClass('getting success')
                        .addClass('error')
                        .html('⚠️ Location not available (check-out will proceed without it)');
                },
                { timeout: 10000 }
            );
        } else {
            $('#locationBadge')
                .removeClass('getting success')
                .addClass('error')
                .html('⚠️ Geolocation not supported by this browser');
        }

        $('input[name="verificationType"]').change(function() {
            if ($(this).val() === 'id') {
                $('#cameraContainer').hide();
                $('#enrolledPhoto').hide();
                $('#manualCheckoutBtn').show();
                $('#startVerifyBtn').hide();
                $('#verifyBtn').hide();
                $('#stopVerifyBtn').hide();
                stopVerification();
            } else {
                $('#manualCheckoutBtn').hide();
                $('#startVerifyBtn').show();
            }
        });

        $('#academySelect').change(function() {
            loadCohortsForCheckout($(this).val());
            loadStudentsForCheckout();
        });

        $('#cohortSelect').change(function() {
            loadStudentsForCheckout();
        });
    });

    function loadAcademiesForCheckout() {
        $.get('/api/academies', function(academies) {
            academies.forEach(function(a) {
                $('#academySelect').append('<option value="' + a.id + '">' + a.academy_name + '</option>');
            });
        });
    }

    function loadCohortsForCheckout(academyId) {
        var url = '/api/cohorts';
        if (academyId) url += '?academy_id=' + academyId;

        $('#cohortSelect').html('<option value="">Loading...</option>');

        $.get(url, function(cohorts) {
            $('#cohortSelect').html('<option value="">All Cohorts</option>');
            cohorts.forEach(function(c) {
                $('#cohortSelect').append('<option value="' + c.id + '">' + c.cohort_name + '</option>');
            });
        });
    }

    function loadStudentsForCheckout() {
        var academyId = $('#academySelect').val();
        var cohortId = $('#cohortSelect').val();

        var url = '/api/students/list';
        var params = [];
        if (academyId) params.push('academy_id=' + academyId);
        if (cohortId) params.push('cohort_id=' + cohortId);
        if (params.length > 0) url += '?' + params.join('&');

        $.get(url, function(students) {
            $('#studentId').attr('placeholder', students.length > 0
                ? 'Students available: ' + students.length
                : 'Enter your student ID');
        });
    }

    async function loadModels() {
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            await faceapi.nets.faceLandmark68Net.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            await faceapi.nets.faceRecognitionNet.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            modelsLoaded = true;
        } catch (error) {
            console.error('Error loading models:', error);
        }
    }

    async function startVerification() {
        const studentId = $('#studentId').val();
        if (!studentId) {
            alert('Please enter your student ID');
            return;
        }

        showLoading('Loading student data...');

        $.ajax({
            url: `/api/students/${studentId}/face-data`,
            success: function(response) {
                hideLoading();

                if (!response.face_descriptor) {
                    alert('Face not enrolled for this student. Please contact admin to enroll your face.');
                    return;
                }

                currentStudentDescriptor = new Float32Array(JSON.parse(response.face_descriptor));

                if (response.face_photo) {
                    $('#enrolledPhotoImg').attr('src', response.face_photo);
                    $('#enrolledPhoto').show();
                }

                startCamera();
            },
            error: function() {
                hideLoading();
                alert('Student not found or no face enrolled');
            }
        });
    }

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'user', width: 640, height: 480 }
            });
            video.srcObject = stream;
            $('#cameraContainer').show();
            $('#startVerifyBtn').hide();
            $('#verifyBtn').show();
            $('#verifyBtn').prop('disabled', false);
            $('#stopVerifyBtn').show();
        } catch (error) {
            alert('Camera error: ' + error.message);
        }
    }

    function stopVerification() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        $('#cameraContainer').hide();
        $('#startVerifyBtn').show();
        $('#verifyBtn').hide();
        $('#stopVerifyBtn').hide();
        $('#verifyBtn').prop('disabled', true);
    }

    async function verifyFace() {
        if (!modelsLoaded) {
            alert('Models still loading, please wait...');
            return;
        }

        if (!currentStudentDescriptor) {
            alert('Please start verification first');
            return;
        }

        showLoading('Verifying face...');

        const detection = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {
            hideLoading();
            showResult(false, 'No face detected! Please position your face in the camera.');
            return;
        }

        const labeled = new faceapi.LabeledFaceDescriptors('student', [currentStudentDescriptor]);
        const faceMatcher = new faceapi.FaceMatcher([labeled], 0.6);

        const match = faceMatcher.findBestMatch(detection.descriptor);

        hideLoading();

        if (match.label === 'student') {
            const studentId = $('#studentId').val();
            performCheckOut(studentId);
        } else {
            showResult(false, 'Face does not match! Please try again or use manual check-out.');
        }
    }

    function manualCheckout() {
        const studentId = $('#studentId').val();
        if (!studentId) {
            alert('Please enter your student ID');
            return;
        }
        performCheckOut(studentId);
    }

    function performCheckOut(studentId) {
        showLoading('Checking out...');

        $.ajax({
            url: '/api/attendance/checkout',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                student_id: studentId
            }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    const statusBadge = response.attendance.status === 'left_early'
                        ? '<span class="badge bg-warning text-dark">Left Early</span>'
                        : '<span class="badge bg-success">Completed</span>';

                    showResult(true, `
                        <h4>✅ Check-out Successful!</h4>
                        <div class="info-box">
                            <div class="info-row">
                                <span class="info-label">Name:</span>
                                <span class="info-value">${response.attendance.student_name}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Check-in Time:</span>
                                <span class="info-value">${response.attendance.check_in_time}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Check-out Time:</span>
                                <span class="info-value">${response.attendance.check_out_time}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Status:</span>
                                ${statusBadge}
                            </div>
                        </div>
                    `);
                    stopVerification();
                } else {
                    showResult(false, response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                const response = JSON.parse(xhr.responseText);
                showResult(false, response.message || 'Check-out failed');
            }
        });
    }

    function showResult(success, message) {
        const resultDiv = $('#verificationResult');
        resultDiv.html(`<div class="verification-result ${success ? 'verification-success' : 'verification-fail'}">${message}</div>`);
    }

    function showLoading(message) {
        $('body').append(`
            <div id="loadingOverlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);display:flex;justify-content:center;align-items:center;z-index:9999;">
                <div style="text-align:center;color:white;">
                    <div class="spinner-border text-warning mb-3"></div>
                    <p>${message}</p>
                </div>
            </div>
        `);
    }

    function hideLoading() {
        $('#loadingOverlay').remove();
    }
</script>
@endsection
