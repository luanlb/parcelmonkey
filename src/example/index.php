<?PHP

$pc = new Parcelmonkey\ParcelAPI();

$helloworld = $pc->HelloWorld("Hello Monkey!!!");

echo "<pre>";
var_dump($helloworld);
echo "</pre>";

$quote = new Parcelmonkey\model\Quote();

$box = new Parcelmonkey\model\Box(10, 10, 10, 1);

$sender           = new Parcelmonkey\model\Sender();
$sender->name     = "Rich";
$sender->phone    = "01234567890";
$sender->address1 = "Unit 21 Tollgate";
$sender->town     = "Eastleigh";
$sender->county   = "Hampshire";
$sender->postcode = "SO53 3TG";

$recipient           = new Parcelmonkey\model\Recipient();
$recipient->name     = "Nicola";
$recipient->phone    = "01234567890";
$recipient->email    = "nicola@example.com";
$recipient->address1 = "Hilton Midtown";
$recipient->town     = "New York";
$recipient->county   = "NY";
$recipient->postcode = "10019";

$quote->origin      = "GB";
$quote->destination = "US";
$quote->goods_value = 150;
$quote->collection_date   = "2017-07-4";
$quote->boxes       = array($box);
$quote->sender      = $sender;
$quote->recipient   = $recipient;

$getquote = $pc->GetQuote($quote);

echo "<pre>";
var_dump($getquote);
echo "</pre>";

$item                 = new Parcelmonkey\model\Item();
$item->quantity       = 1;
$item->description    = "B Book";
$item->value_per_unit = 150;

$item2                 = new Parcelmonkey\model\Item();
$item2->quantity       = 3;
$item2->description    = "A Book";
$item2->value_per_unit = 150;

$custom                          = new Parcelmonkey\model\Custom();
$custom->doc_type                = "commercial";
$custom->reason                  = "Sold";
$custom->sender_name             = "Rich";
$custom->sender_tax_reference    = "Private Individual";
$custom->recipient_name          = "Nicola";
$custom->recipient_tax_reference = "Private Individual";
$custom->country_of_manufacture  = "GB";
$custom->items                   = array($item, $item2);

$shipment                    = new Parcelmonkey\model\Shipment();
$shipment->service           = $getquote[0]->GetService();
$shipment->origin            = "GB";
$shipment->destination       = "US";
$shipment->goods_value       = 150;
$shipment->goods_description = "Books";
$shipment->delivery_notes    = "It is the red door";
$shipment->collection_date   = "2017-07-4";
$shipment->boxes             = array($box);
$shipment->sender            = $sender;
$shipment->recipient         = $recipient;
$shipment->customs           = $custom;

$createshipment = $pc->CreateShipment($shipment);

echo "<pre>";
var_dump($createshipment);
echo "</pre>";
