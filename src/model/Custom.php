<?php
namespace Parcelmonkey\model;

class Custom
{
    public $doc_type;
    public $reason;
    public $sender_name;
    public $sender_tax_reference;
    public $recipient_name;
    public $recipient_tax_reference;
    public $country_of_manufacture;
    public $items;

    public function __construct()
    {
    }
}
