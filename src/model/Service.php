<?php
namespace Parcelmonkey\model;

class Service
{
    private $service;
    private $carrier;
    private $service_name;
    private $service_description;
    private $customs_invoice_required;
    private $shipping_price_net;
    private $protection_price_net;
    private $total_price_net;
    private $total_price_gross;

    public function getService()
    {
        return $this->service;
    }
    public function getCarrier()
    {
        return $this->carrier;
    }
    public function getService_name()
    {
        return $this->service_name;
    }
    public function getService_description()
    {
        return $this->service_description;
    }
    public function getCustoms_invoice_required()
    {
        return $this->customs_invoice_required;
    }
    public function getShipping_price_net()
    {
        return $this->shipping_price_net;
    }
    public function getProtection_price_net()
    {
        return $this->protection_price_net;
    }
    public function getTotal_price_net()
    {
        return $this->total_price_net;
    }
    public function getTotal_price_gross()
    {
        return $this->total_price_gross;
    }

    public function Set($name, $value)
    {
        $this->{$name} = $value;
    }
}
