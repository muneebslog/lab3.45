<?php

namespace App\Support;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use Throwable;

class QrPng
{
    /**
     * Render a QR code as raw PNG bytes using GD (DomPDF-safe; no Imagick needed).
     */
    public static function make(string $content, int $pixelSize = 120, int $marginModules = 1): ?string
    {
        try {
            $qrCode = Encoder::encode($content, ErrorCorrectionLevel::M());
            $matrix = $qrCode->getMatrix();
            $modules = $matrix->getWidth();
            $totalModules = $modules + ($marginModules * 2);
            $scale = max(1, (int) floor($pixelSize / $totalModules));
            $imageSize = $totalModules * $scale;

            $image = imagecreatetruecolor($imageSize, $imageSize);
            if ($image === false) {
                return null;
            }

            $white = imagecolorallocate($image, 255, 255, 255);
            $black = imagecolorallocate($image, 0, 0, 0);
            imagefilledrectangle($image, 0, 0, $imageSize - 1, $imageSize - 1, $white);

            for ($y = 0; $y < $modules; $y++) {
                for ($x = 0; $x < $modules; $x++) {
                    if (! $matrix->get($x, $y)) {
                        continue;
                    }

                    $x1 = ($x + $marginModules) * $scale;
                    $y1 = ($y + $marginModules) * $scale;
                    imagefilledrectangle(
                        $image,
                        $x1,
                        $y1,
                        $x1 + $scale - 1,
                        $y1 + $scale - 1,
                        $black
                    );
                }
            }

            ob_start();
            imagepng($image);
            imagedestroy($image);

            return ob_get_clean() ?: null;
        } catch (Throwable) {
            return null;
        }
    }

    public static function dataUri(string $content, int $pixelSize = 120): ?string
    {
        $png = self::make($content, $pixelSize);

        return $png ? 'data:image/png;base64,'.base64_encode($png) : null;
    }
}
