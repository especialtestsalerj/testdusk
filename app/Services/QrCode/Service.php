<?php

namespace App\Services\QrCode;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\SvgWriter;
class Service
{
    protected $generator;

    public function initialize($content, $size = 80, $margin = -2)
    {
        $writer = new SvgWriter();

        $logoSize = $size * 0.1875;

        // Create QR code
        $qrCode = QrCode::create($content)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize($size)
            ->setMargin($margin)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(public_path('img/logo-alerj-black-qrcode.png'))
            ->setResizeToWidth($logoSize)
            ->setPunchoutBackground(true);

        $this->generator = $writer->write($qrCode, $logo);
    }

    public function generate($content, ...$options)
    {
        $this->initialize($content, ...$options);
        return $this->generator->getDataUri();
    }
}
