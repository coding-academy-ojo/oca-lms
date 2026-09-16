@extends('Layouts.app')

@section('title', 'Check In - OCA LMS')

@section('content')
<style>
    .checkin-card {
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .camera-container {
        position: relative;
        width: 100%;
        max-width: 350px;
        margin: 0 auto;
        display: none;
    }

    #video, #verifyVideo {
        width: 100%;
        border-radius: 12px;
    }

    #enrolledPhoto {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ff7900;
        display: none;
        margin: 0 auto;
    }

    .result-box {
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .result-success {
        background: #d4edda;
        border: 2px solid #28a745;
    }

    .result-error {
        background: #f8d7da;
        border: 2px solid #dc3545;
    }

    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #loadingOverlay .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #fff;
        border-top-color: #ff7900;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin { to { transform: rotate(360deg); } }

    .nav-tabs .nav-link {
        border: none;
        padding: 12px 24px;
        color: #495057;
    }

    .nav-tabs .nav-link.active {
        background: #ff7900;
        color: white;
        border-radius: 8px 8px 0 0;
    }

    .nav-tabs .nav-link:hover {
        border: none;
    }
</style>



<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card checkin-card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Check In - Orange Coding Academy</h4>
                </div>
                <div class="card-body">
                    <!-- Location Status -->
                    <div class="mb-3">
                        <span id="locationBadge" class="badge rounded-pill d-inline-flex align-items-center gap-2 px-3 py-2" style="background: #fff3cd; color: #856404; border: 1px solid #ffc107;">
                            📍 Getting your location...
                        </span>
                    </div>

                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#manual" type="button">
                                🔢 Manual ID
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#face" type="button">
                                📸 Face Recognition
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#qr" type="button">
                                📱 QR Code
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Manual ID Check-in -->
                        <div class="tab-pane fade show active" id="manual">
                            <div class="mb-3">
                                <label class="form-label">Student ID</label>
                                <input type="number" class="form-control" id="studentIdManual" placeholder="Enter your student ID">
                            </div>
                            <button class="btn btn-primary w-100 py-2" onclick="manualCheckin()">Check In</button>
                        </div>

                        <!-- Face Recognition Check-in -->
                        <div class="tab-pane fade" id="face">
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Academy</label>
                                    <select class="form-select" id="faceAcademySelect">
                                        <option value="">All Academies</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Cohort</label>
                                    <select class="form-select" id="faceCohortSelect">
                                        <option value="">All Cohorts</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Student ID</label>
                                    <input type="number" class="form-control" id="studentIdFace" placeholder="Enter your student ID">
                                </div>
                            </div>

                            <div class="camera-container" id="cameraContainer">
                                <video id="verifyVideo" autoplay playsinline></video>
                            </div>

                            <img id="enrolledPhoto" alt="Enrolled photo">

                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-primary" id="startFaceBtn" onclick="startFaceVerification()">Start Camera</button>
                                <button class="btn btn-success" id="verifyFaceBtn" onclick="verifyFace()" disabled>Verify & Check In</button>
                                <button class="btn btn-secondary" id="stopFaceBtn" onclick="stopFaceVerification()" style="display: none;">Stop Camera</button>
                            </div>
                        </div>

                        <!-- QR Code Check-in -->
                        <div class="tab-pane fade" id="qr">
                            <div class="text-center">
                                <p class="text-muted mb-3">Scan the QR code from the reception display</p>
                                <div class="qr-frame p-3 bg-light rounded">
                                    <a href="/attendance/qr-display" target="_blank" class="btn btn-outline-primary">
                                        View QR Code
                                    </a>
                                </div>
                                <hr>
                                <p class="text-muted small">Or enter student ID to check in:</p>
                                <input type="number" class="form-control" id="studentIdQR" placeholder="Enter student ID">
                                <button class="btn btn-primary w-100 py-2 mt-2" onclick="qrCheckin()">Check In with QR</button>
                            </div>
                        </div>
                    </div>

                    <div id="resultContainer"></div>

                    <div class="text-center mt-3">
                        <a href="/attendance/qr-display" class="text-muted small">View QR Display</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="loadingOverlay">
    <div class="spinner"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
<script>
    let faceVideo, faceStream, currentDescriptor = null, modelsLoaded = false;
    let dailyToken = null;
    let userLatitude = null, userLongitude = null;

    window.onload = function() {
        loadFaceModels();
        loadFaceAcademies();
        // Fetch the daily attendance token
        fetch('/api/attendance/qr')
            .then(res => res.json())
            .then(data => { dailyToken = data.token; })
            .catch(err => console.error('Failed to fetch daily token:', err));
        
        // Get GPS location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    userLatitude = pos.coords.latitude;
                    userLongitude = pos.coords.longitude;
                    const badge = document.getElementById('locationBadge');
                    badge.style.background = '#d4edda';
                    badge.style.color = '#155724';
                    badge.style.borderColor = '#28a745';
                    badge.innerHTML = '✅ Location acquired';
                },
                function() {
                    const badge = document.getElementById('locationBadge');
                    badge.style.background = '#f8d7da';
                    badge.style.color = '#721c24';
                    badge.style.borderColor = '#dc3545';
                    badge.innerHTML = '⚠️ Location not available (check-in will proceed without it)';
                },
                { timeout: 10000 }
            );
        } else {
            const badge = document.getElementById('locationBadge');
            badge.style.background = '#f8d7da';
            badge.style.color = '#721c24';
            badge.style.borderColor = '#dc3545';
            badge.innerHTML = '⚠️ Geolocation not supported by this browser';
        }
    };
    
    function loadFaceAcademies() {
        fetch('/api/academies')
            .then(res => res.json())
            .then(academies => {
                academies.forEach(a => {
                    const option = document.createElement('option');
                    option.value = a.id;
                    option.textContent = a.academy_name;
                    document.getElementById('faceAcademySelect').appendChild(option);
                });
            });
        
        document.getElementById('faceAcademySelect').addEventListener('change', function() {
            loadFaceCohorts(this.value);
        });
        
        document.getElementById('faceCohortSelect').addEventListener('change', function() {
            loadFaceStudents();
        });
    }
    
    function loadFaceCohorts(academyId) {
        const select = document.getElementById('faceCohortSelect');
        select.innerHTML = '<option value="">Loading...</option>';
        
        let url = '/api/cohorts';
        if (academyId) url += `?academy_id=${academyId}`;
        
        fetch(url)
            .then(res => res.json())
            .then(cohorts => {
                select.innerHTML = '<option value="">All Cohorts</option>';
                cohorts.forEach(c => {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.textContent = c.cohort_name;
                    select.appendChild(option);
                });
            });
    }
    
    function loadFaceStudents() {
        const academyId = document.getElementById('faceAcademySelect').value;
        const cohortId = document.getElementById('faceCohortSelect').value;
        
        let url = '/api/students/list';
        const params = [];
        if (academyId) params.push(`academy_id=${academyId}`);
        if (cohortId) params.push(`cohort_id=${cohortId}`);
        if (params.length > 0) url += '?' + params.join('&');
        
        fetch(url)
            .then(res => res.json())
            .then(students => {
                const input = document.getElementById('studentIdFace');
                input.placeholder = students.length > 0 
                    ? `Students available: ${students.length}` 
                    : 'Enter your student ID';
            });
    }

    async function loadFaceModels() {
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            await faceapi.nets.faceLandmark68Net.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            await faceapi.nets.faceRecognitionNet.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            modelsLoaded = true;
        } catch (error) {
            console.log('Face models loading error:', error);
        }
    }

    function manualCheckin() {
        const studentId = document.getElementById('studentIdManual').value;
        if (!studentId) { showResult(false, 'Please enter student ID'); return; }
        performCheckIn(studentId, 'manual', dailyToken);
    }

    function qrCheckin() {
        const studentId = document.getElementById('studentIdQR').value;
        if (!studentId) { showResult(false, 'Please enter student ID'); return; }
        performCheckIn(studentId, 'qr', dailyToken);
    }

    async function startFaceVerification() {
        const studentId = document.getElementById('studentIdFace').value;
        if (!studentId) { showResult(false, 'Please enter student ID'); return; }

        showLoading('Loading student data...');
        
        try {
            const res = await fetch(`/api/students/${studentId}/face-data`);
            const data = await res.json();
            
            if (!data.face_descriptor) {
                hideLoading();
                showResult(false, 'Face not enrolled for this student!');
                return;
            }

            currentDescriptor = new Float32Array(JSON.parse(data.face_descriptor));
            
            if (data.face_photo) {
                const img = document.getElementById('enrolledPhoto');
                img.src = data.face_photo;
                img.style.display = 'block';
            }

            hideLoading();
            
            faceStream = await navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: 'user', width: 640, height: 480 } 
            });
            faceVideo = document.getElementById('verifyVideo');
            faceVideo.srcObject = faceStream;
            
            document.getElementById('cameraContainer').style.display = 'block';
            document.getElementById('startFaceBtn').style.display = 'none';
            document.getElementById('verifyFaceBtn').style.display = 'block';
            document.getElementById('verifyFaceBtn').disabled = false;
            document.getElementById('stopFaceBtn').style.display = 'block';
        } catch (error) {
            hideLoading();
            showResult(false, 'Error: ' + error.message);
        }
    }

    async function verifyFace() {
        if (!modelsLoaded || !currentDescriptor) {
            showResult(false, 'System not ready. Please refresh and try again.');
            return;
        }

        showLoading('Verifying face...');

        const detection = await faceapi.detectSingleFace(faceVideo, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {
            hideLoading();
            showResult(false, 'No face detected!');
            return;
        }

        const labeled = new faceapi.LabeledFaceDescriptors('student', [currentDescriptor]);
        const faceMatcher = new faceapi.FaceMatcher([labeled], 0.6);
        const match = faceMatcher.findBestMatch(detection.descriptor);
        
        hideLoading();

        if (match.label === 'student') {
            const studentId = document.getElementById('studentIdFace').value;
            performCheckIn(studentId, 'face');
            stopFaceVerification();
        } else {
            showResult(false, 'Face does not match!');
        }
    }

    function stopFaceVerification() {
        if (faceStream) faceStream.getTracks().forEach(track => track.stop());
        document.getElementById('cameraContainer').style.display = 'none';
        document.getElementById('startFaceBtn').style.display = 'block';
        document.getElementById('verifyFaceBtn').style.display = 'none';
        document.getElementById('stopFaceBtn').style.display = 'none';
        document.getElementById('enrolledPhoto').style.display = 'none';
    }

    function performCheckIn(studentId, type, token = null) {
        const usedToken = token || dailyToken;
        if (!usedToken) {
            showResult(false, 'Could not get today\'s attendance token. Please refresh the page.');
            return;
        }
        showLoading('Checking in...');

        const body = { student_id: studentId, token: usedToken };

        // Add location data if available
        if (userLatitude !== null && userLongitude !== null) {
            body.latitude = userLatitude;
            body.longitude = userLongitude;
        }

        fetch('/api/attendance/checkin', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(body)
        })
        .then(res => res.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                const statusBadge = data.attendance.status === 'present' 
                    ? '<span class="badge bg-success">Present</span>' 
                    : '<span class="badge bg-warning">Late</span>';
                
                const locationInfo = (userLatitude !== null && userLongitude !== null)
                    ? `<p><strong>📍 Location:</strong> ${userLatitude.toFixed(5)}, ${userLongitude.toFixed(5)}</p>`
                    : '<p class="text-muted small">📍 Location not captured</p>';
                
                showResult(true, `
                    <h5>✅ Check-in Successful!</h5>
                    <p><strong>Name:</strong> ${data.attendance.student_name}</p>
                    <p><strong>Time:</strong> ${data.attendance.check_in_time}</p>
                    <p><strong>Type:</strong> ${type === 'face' ? 'Face Recognition' : type === 'qr' ? 'QR Code' : 'Manual ID'}</p>
                    ${locationInfo}
                    ${statusBadge}
                `);
            } else {
                showResult(false, data.message);
            }
        })
        .catch(err => {
            hideLoading();
            showResult(false, 'Network error. Please try again.');
        });
    }

    function showResult(success, message) {
        const container = document.getElementById('resultContainer');
        container.innerHTML = `
            <div class="result-box ${success ? 'result-success' : 'result-error'}">
                ${message}
            </div>
        `;
    }

    function showLoading(msg) {
        document.getElementById('loadingOverlay').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }
</script>
@endsection