<?php

namespace App\Services;

use App\Models\Attendance;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;

class QrCodeService
{
    public function generateDailyAttendanceQr()
    {
        $token = Attendance::generateDailyToken();
        $data = json_encode([
            'token' => $token,
            'date' => now()->toDateString(),
            'endpoint' => config('app.url') . '/api/attendance/checkin'
        ]);

        $qrCode = new QrCode(
            data: $data,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $writer = new SvgWriter();
        return $writer->write($qrCode)->getString();
    }

    public function getQrAsBase64()
    {
        $qrImage = $this->generateDailyAttendanceQr();
        return 'data:image/png;base64,' . base64_encode($qrImage);
    }

    public function getQrDataUrl()
    {
        $qrImage = $this->generateDailyAttendanceQr();
        return 'data:image/svg+xml;base64,' . base64_encode($qrImage);
    }
}