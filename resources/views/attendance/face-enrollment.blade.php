@extends('Layouts.app')

@section('title', 'Face Enrollment - OCA LMS')

@section('content')
<style>
    .camera-container {
        position: relative;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }
    
    #video {
        width: 100%;
        border-radius: 12px;
        display: block;
    }
    
    .enrollment-card {
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .face-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ff7900;
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
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card enrollment-card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Face Enrollment</h4>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Select a student and capture their face</p>
                    
                    <div class="row g-3 mb-4">
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
                            <label class="form-label">Select Student</label>
                            <select class="form-select" id="studentSelect">
                                <option value="">Choose a student...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="camera-container mb-3">
                        <video id="video" autoplay playsinline></video>
                    </div>
                    
                    <div class="mb-3" id="previewContainer" style="display: none;">
                        <img id="photoPreview" class="face-preview mb-2" alt="Face preview">
                        <p class="text-muted" id="detectionStatus"></p>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" id="startCameraBtn" onclick="startCamera()">Start Camera</button>
                        <button class="btn btn-success" id="captureBtn" onclick="captureFace()" disabled>Capture Face</button>
                        <button class="btn btn-warning" id="enrollBtn" onclick="enrollFace()" disabled>Enroll Face</button>
                        <button class="btn btn-secondary" id="stopCameraBtn" onclick="stopCamera()" style="display: none;">Stop Camera</button>
                    </div>
                    
                    <div class="mt-3" id="enrollmentResult"></div>
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
    let videoEl, stream, modelsLoaded = false;
    let faceDescriptor = null, capturedImage = null;

    window.onload = function() {
        loadAcademies();
        loadStudents();
        videoEl = document.getElementById('video');
        loadModels();
        
        document.getElementById('academySelect').addEventListener('change', function() {
            loadCohorts(this.value);
            loadStudents();
        });
        
        document.getElementById('cohortSelect').addEventListener('change', function() {
            loadStudents();
        });
    };

    async function loadModels() {
        showLoading('Loading face detection models...');
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            await faceapi.nets.faceLandmark68Net.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            await faceapi.nets.faceRecognitionNet.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/');
            modelsLoaded = true;
            hideLoading();
            alert('Models loaded! You can now use face enrollment.');
        } catch (error) {
            hideLoading();
            alert('Error loading models: ' + error.message);
        }
    }

    function loadStudents() {
        const academyId = document.getElementById('academySelect').value;
        const cohortId = document.getElementById('cohortSelect').value;
        
        let url = '/api/students/list';
        const params = [];
        if (academyId) params.push(`academy_id=${academyId}`);
        if (cohortId) params.push(`cohort_id=${cohortId}`);
        if (params.length > 0) url += '?' + params.join('&');
        
        fetch(url)
            .then(res => res.json())
            .then(students => {
                const select = document.getElementById('studentSelect');
                select.innerHTML = '<option value="">Choose a student...</option>';
                students.forEach(s => {
                    const option = document.createElement('option');
                    option.value = s.id;
                    option.textContent = `ID: ${s.id} - ${s.en_first_name || ''} ${s.en_last_name || ''}`;
                    select.appendChild(option);
                });
            });
    }
    
    function loadAcademies() {
        fetch('/api/academies')
            .then(res => res.json())
            .then(academies => {
                const select = document.getElementById('academySelect');
                academies.forEach(a => {
                    const option = document.createElement('option');
                    option.value = a.id;
                    option.textContent = a.academy_name;
                    select.appendChild(option);
                });
            });
    }
    
    function loadCohorts(academyId = null) {
        const select = document.getElementById('cohortSelect');
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

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user', width: 640, height: 480 } });
            videoEl.srcObject = stream;
            document.getElementById('startCameraBtn').style.display = 'none';
            document.getElementById('stopCameraBtn').style.display = 'block';
            document.getElementById('captureBtn').disabled = false;
        } catch (error) {
            alert('Camera error: ' + error.message);
        }
    }

    function stopCamera() {
        if (stream) stream.getTracks().forEach(track => track.stop());
        document.getElementById('startCameraBtn').style.display = 'block';
        document.getElementById('stopCameraBtn').style.display = 'none';
        document.getElementById('captureBtn').disabled = true;
    }

    async function captureFace() {
        if (!modelsLoaded) { alert('Models still loading...'); return; }
        
        showLoading('Detecting face...');
        
        const detections = await faceapi.detectSingleFace(videoEl, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        hideLoading();

        if (!detections) {
            alert('No face detected! Position your face in camera.');
            return;
        }

        faceDescriptor = Array.from(detections.descriptor);
        
        const canvas = document.createElement('canvas');
        canvas.width = videoEl.videoWidth;
        canvas.height = videoEl.videoHeight;
        canvas.getContext('2d').drawImage(videoEl, 0, 0);
        capturedImage = canvas.toDataURL('image/jpeg');

        document.getElementById('previewContainer').style.display = 'block';
        document.getElementById('photoPreview').src = capturedImage;
        document.getElementById('detectionStatus').textContent = 'Face detected! Click "Enroll Face" to save.';
        document.getElementById('enrollBtn').disabled = false;
        document.getElementById('captureBtn').disabled = true;
    }

    function enrollFace() {
        const studentId = document.getElementById('studentSelect').value;
        if (!studentId) { alert('Select a student'); return; }
        if (!faceDescriptor) { alert('Capture a face first'); return; }

        showLoading('Enrolling face...');

        const formData = new FormData();
        formData.append('student_id', studentId);
        formData.append('face_descriptor', JSON.stringify(faceDescriptor));
        formData.append('face_photo', capturedImage);

        fetch('/api/students/enroll-face', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            hideLoading();
            document.getElementById('enrollmentResult').innerHTML = '<div class="alert alert-success">Face enrolled successfully!</div>';
            resetEnrollment();
        })
        .catch(err => {
            hideLoading();
            alert('Error enrolling face');
        });
    }

    function resetEnrollment() {
        faceDescriptor = null;
        capturedImage = null;
        document.getElementById('previewContainer').style.display = 'none';
        document.getElementById('enrollBtn').disabled = true;
        document.getElementById('captureBtn').disabled = false;
    }

    function showLoading(msg) {
        document.getElementById('loadingOverlay').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }
</script>
@endsection