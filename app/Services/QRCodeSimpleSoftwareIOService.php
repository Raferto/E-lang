<?php
namespace App\Services;

use App\Interfaces\QRCodeInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeSimpleSoftwareIOService implements QRCodeInterface {
    public function createQRCode($data) {
        return QrCode::size(130)->generate($data);
    }
}
