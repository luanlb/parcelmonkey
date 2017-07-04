<?php
namespace Parcelmonkey\model;

class Shipment
{
    public $service;
    public $origin;
    public $destination;
    public $boxes;
    public $goods_value;
    public $goods_description;
    public $delivery_notes;
    public $collection_date;    
    public $sender;
    public $recipient;
    public $customs;

    public function __construct()
    {

    }
    
}
