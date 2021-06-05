<?php
namespace App\Services;

use App\Interfaces\QRCodeInterface;
use chillerlan\QRCode\QRCode;

class QRCodeChillerlanService implements QRCodeInterface {
    public function createQRCode($data) {
        return (new QRCode)->render(
            $data
        );
    }
}
