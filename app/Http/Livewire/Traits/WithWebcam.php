<?php

namespace App\Http\Livewire\Traits;

trait WithWebcam
{
    public $webcamFile;
    public $webcamDataUri;
    public $hasWebcamPhoto;

    public $x;
    public $y;
    public $width;
    public $height;

    public $iteration = 0;

    public function mountCoordinates()
    {
        $this->x = 0;
        $this->y = 0;

        if ($this->hasWebcamPhoto) {
            $this->width = 400;
            $this->height = 400;
        } else {
            $this->width = 75;
            $this->height = 75;
        }
    }

    public function removeWebcamFile()
    {
        $this->webcamFile = no_photo();
        $this->webcamDataUri = false;
        $this->hasWebcamPhoto = false;
        $this->visitor->photo = null;
        $this->mountCoordinates();
    }

    public function imageUploaded()
    {
        $this->webcamDataUri = false;
        $this->hasWebcamPhoto = true;
    }

    public function takeSnapshot()
    {
        $this->hasWebcamPhoto = true;
        $this->webcamDataUri = false;
    }

    public function cropChanged($event)
    {
        $this->x = $event['x'];
        $this->y = $event['y'];
        $this->width = $event['width'];
        $this->height = $event['height'];
    }
}
