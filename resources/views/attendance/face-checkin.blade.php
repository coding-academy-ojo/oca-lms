@extends('Layouts.app')

@section('title', 'Face Check-in - OCA LMS')

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
    
    .enrollment-card {
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

    .duration-box {
        background: linear-gradient(135deg, #ff7900, #ff5500);
        color: white;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
    }

    .duration-timer {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 2px;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card enrollment-card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📸 Face Check-in</h4>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Enter your Student ID and take a photo to check in</p>
                    
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
                            ✅ Verify & Check In
                        </button>
                        <button class="btn btn-warning" id="manualCheckinBtn" onclick="manualCheckin()" style="display: none;">
                            ✓ Check In with ID
                        </button>
                        <button class="btn btn-secondary" id="stopVerifyBtn" onclick="stopVerification()" style="display: none;">
                            Stop Camera
                        </button>
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
    let dailyToken = null;
    let userLatitude = null, userLongitude = null;
    let durationInterval = null, checkInTimestamp = null;

    $(document).ready(function() {
        loadModels();
        loadAcademiesForCheckin();
        video = document.getElementById('verificationVideo');

        // Fetch the daily attendance token
        $.get('/api/attendance/qr', function(data) {
            dailyToken = data.token;
        }).fail(function() {
            console.error('Failed to fetch daily attendance token.');
        });

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
                        .html('⚠️ Location not available (check-in will proceed without it)');
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
                $('#manualCheckinBtn').show();
                $('#startVerifyBtn').hide();
                $('#verifyBtn').hide();
                $('#stopVerifyBtn').hide();
                stopVerification();
            } else {
                $('#manualCheckinBtn').hide();
                $('#startVerifyBtn').show();
            }
        });
        
        $('#academySelect').change(function() {
            loadCohortsForCheckin($(this).val());
            loadStudentsForCheckin();
        });
        
        $('#cohortSelect').change(function() {
            loadStudentsForCheckin();
        });
    });
    
    function loadAcademiesForCheckin() {
        $.get('/api/academies', function(academies) {
            academies.forEach(function(a) {
                $('#academySelect').append('<option value="' + a.id + '">' + a.academy_name + '</option>');
            });
        });
    }
    
    function loadCohortsForCheckin(academyId) {
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
    
    function loadStudentsForCheckin() {
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
            performCheckIn(studentId);
        } else {
            showResult(false, 'Face does not match! Please try again or use manual check-in.');
        }
    }

    function manualCheckin() {
        const studentId = $('#studentId').val();
        if (!studentId) {
            alert('Please enter your student ID');
            return;
        }
        performCheckIn(studentId);
    }

    function performCheckIn(studentId) {
        if (!dailyToken) {
            showResult(false, 'Could not get today\'s attendance token. Please refresh the page and try again.');
            return;
        }

        showLoading('Checking in...');
        
        const requestBody = {
            student_id: studentId,
            token: dailyToken
        };

        if (userLatitude !== null && userLongitude !== null) {
            requestBody.latitude  = userLatitude;
            requestBody.longitude = userLongitude;
        }

        $.ajax({
            url: '/api/attendance/checkin',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(requestBody),
            success: function(response) {
                hideLoading();
                if (response.success) {
                    const locationInfo = (userLatitude !== null)
                        ? `<p><strong>📍 Location:</strong> ${userLatitude.toFixed(5)}, ${userLongitude.toFixed(5)}</p>`
                        : `<p class="text-muted small">📍 Location not captured</p>`;

                    showResult(true, `
                        <h4>✅ Check-in Successful!</h4>
                        <p><strong>Name:</strong> ${response.attendance.student_name}</p>
                        <p><strong>Time:</strong> ${response.attendance.check_in_time}</p>
                        <p><strong>Status:</strong> ${response.attendance.status}</p>
                        ${locationInfo}
                        <div class="duration-box mt-3">
                            <div class="text-white-50 small mb-1">⏱️ Session Duration</div>
                            <div class="duration-timer" id="durationTimer">00:00:00</div>
                        </div>
                    `);
                    stopVerification();
                    startDurationTimer();
                } else {
                    showResult(false, response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                const response = JSON.parse(xhr.responseText);
                showResult(false, response.message || 'Check-in failed');
            }
        });
    }

    function showResult(success, message) {
        const resultDiv = $('#verificationResult');
        resultDiv.html(`<div class="verification-result ${success ? 'verification-success' : 'verification-fail'}">${message}</div>`);
    }

    function startDurationTimer() {
        clearInterval(durationInterval);
        checkInTimestamp = Date.now();
        durationInterval = setInterval(function() {
            const elapsed = Math.floor((Date.now() - checkInTimestamp) / 1000);
            const h = String(Math.floor(elapsed / 3600)).padStart(2, '0');
            const m = String(Math.floor((elapsed % 3600) / 60)).padStart(2, '0');
            const s = String(elapsed % 60).padStart(2, '0');
            const el = document.getElementById('durationTimer');
            if (el) el.textContent = `${h}:${m}:${s}`;
            else clearInterval(durationInterval);
        }, 1000);
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