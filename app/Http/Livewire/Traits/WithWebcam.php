<?php

namespace App\Http\Livewire\Traits;

trait WithWebcam
{
    public $webcam_file;
    public $webcam_data_uri;
    public $hasWebcamPhoto;

    public $x;
    public $y;
    public $width;
    public $height;

    public $iteration = 0;

    public function removeWebcamFile()
    {
        $this->webcam_file = '';
        $this->x = 0;
        $this->y = 0;
        $this->width = 400;
        $this->height = 400;
        $this->webcam_data_uri = false;
        $this->hasWebcamPhoto = false;
        $this->photo = null;
        $this->visitor->photo = null;

        //Force update of crop panel
        $this->iteration = $this->iteration + 1;
    }

    public function imageUploaded()
    {
        $this->webcam_data_uri = false;
        $this->hasWebcamPhoto = true;
    }

    public function takeSnapshot()
    {
        $this->x = 0;
        $this->y = 0;
        $this->width = 400;
        $this->height = 400;

        $this->webcam_data_uri = false;
        $this->hasWebcamPhoto = true;

//        Force update of crop panel
        $this->iteration = $this->iteration + 1;
    }

    public function cropChanged($event)
    {
        $this->x = $event['x'];
        $this->y = $event['y'];
        $this->width = $event['width'];
        $this->height = $event['height'];
    }
}
