<?php
namespace Parcelmonkey\model;

class Shipment_res
{
    private $ShipmentId;
    private $label_url;
    private $tracking_url;

    public function getShipmentId()
    {
        return $this->ShipmentId;
    }
    public function getLabel_url()
    {
        return $this->label_url;
    }
    public function getTracking_url()
    {
        return $this->tracking_url;
    }

    public function Set($name, $value)
    {
        $this->{$name} = $value;
    }
}
