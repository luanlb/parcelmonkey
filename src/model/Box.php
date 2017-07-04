<?php
namespace Parcelmonkey\model;

class Box
{
    public $length;
    public $width;
    public $height;
    public $weight;

    public function __construct($length, $width, $height, $weight)
    {
        $this->length = $length;
        $this->width  = $width;
        $this->height = $height;
        $this->weight = $weight;
    }

}
