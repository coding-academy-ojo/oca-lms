@extends('Layouts.app')

@section('title', 'Daily Attendance QR - OCA LMS')

@section('content')
<style>
    .qr-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        display: inline-block;
        margin: 20px 0;
    }

    .qr-container img {
        width: 280px;
        height: 280px;
        border-radius: 10px;
    }

    .instructions {
        color: #555;
        font-size: 14px;
        margin-top: 20px;
        line-height: 1.6;
        background: #e9ecef;
        padding: 15px 20px;
        border-radius: 10px;
        text-align: left;
    }

    .instructions strong {
        color: #ff7900;
    }

    .refresh-indicator {
        display: inline-block;
        background: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        color: #666;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .loading {
        opacity: 0.5;
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem !important;
        }
        
        .card-body h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem !important;
        }
        
        #currentDate {
            font-size: 0.85rem;
            margin-bottom: 0.5rem !important;
        }
        
        .qr-container {
            padding: 12px;
            margin: 10px 0;
        }
        
        .qr-container img {
            width: 180px;
            height: 180px;
        }
        
        .instructions {
            font-size: 12px;
            padding: 12px;
            margin-top: 15px;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 6px 10px;
        }
        
        .footer {
            font-size: 0.75rem;
        }
    }

    @media (min-width: 577px) and (max-width: 767px) {
        .qr-container img {
            width: 220px;
            height: 220px;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .card-body {
            padding: 2.5rem !important;
        }
        
        .card-body h3 {
            font-size: 1.75rem;
        }
        
        .qr-container img {
            width: 250px;
            height: 250px;
        }
    }

    @media (min-width: 1200px) {
        .card-body {
            padding: 3rem !important;
        }
        
        .qr-container img {
            width: 320px;
            height: 320px;
        }
    }
</style>

<div class="container my-4 my-md-5">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-9 col-lg-7 col-xl-6">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark">
                            🔄 Auto-refreshes at midnight
                        </span>
                    </div>
                    
                    <h3 class="text-primary mb-3">📱 Daily Attendance</h3>
                    <p class="text-muted" id="currentDate"></p>
                    
                    <div class="qr-container">
                        <img id="qrImage" src="" alt="Attendance QR Code">
                    </div>

                    <div class="instructions">
                        <strong>Instructions:</strong><br>
                        1. Open OCA LMS mobile app or visit check-in page<br>
                        2. Scan this QR code<br>
                        3. Enter your student ID to check in<br>
                        4. Get marked as Present or Late automatically
                    </div>

                    <p class="text-muted small mt-3">
                        Powered by Orange Coding Academy LMS
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadQRCode() {
        const container = document.querySelector('.card-body');
        container.classList.add('loading');
        
        fetch('/api/attendance/qr')
            .then(response => response.json())
            .then(data => {
                document.getElementById('qrImage').src = data.qr_image;
                document.getElementById('currentDate').textContent = data.date;
                container.classList.remove('loading');
            })
            .catch(error => {
                console.error('Error loading QR:', error);
                container.classList.remove('loading');
            });
    }

    document.getElementById('currentDate').textContent = new Date().toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    loadQRCode();
    setInterval(loadQRCode, 60000);
</script>
@endsection