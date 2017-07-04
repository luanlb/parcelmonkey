<?PHP

namespace Parcelmonkey;

use Curl;
use ReflectionObject;
use Parcelmonkey\model;

class ParcelAPI
{
    const API_URL = 'https://api.parcelmonkey.co.uk';
    const API_VER = '3.0';
    private $userid;
    private $token;

    public function __construct()
    {
        $userid = config('parcel_config')['userid'];
        $token = config('parcel_config')['token'];
        $this->userid = $userid;
        $this->token  = $token;
    }

    //This service to test your connectivity with the API
    public function HelloWorld($echo)
    {
        $url  = "/HelloWorld";
        $data = '{"echo":"' . $echo . '"}';
        $res  = $this->postJsonData($url, $data);
        if ($res['status'] === 200) {
            $result = new model\HelloWorld($res['response']->echo, $res['response']->hello);
            return $result;
        } else {
            return array('error_code' => $res['status'], "err_message" => $res['response']->error);
        }
    }

    //This service returns a list of quotes for services suitable for the parcel parameters you specify in the request.
    //return list of Service
    public function GetQuote($quote)
    {
        $services = [];
        $url      = "/GetQuote";
        $data     = json_encode($quote);
        $res      = $this->postJsonData($url, $data);
        if ($res['status'] === 200) {
            foreach ($res['response'] as $key => $value) {
                $service    = new model\Service();
                $cast       = $this->castClass($service, $value);
                $services[] = $cast;
            }
            return $services;
        } else {
            return array('error_code' => $res['status'], "err_message" => $res['response']->error);
        }
    }

    //This service creates a shipment and puts it in your Parcel Monkey basket.
    //return Shipment_res
    public function CreateShipment($shipment)
    {
        $services = [];
        $url      = "/CreateShipment";
        $data     = json_encode($shipment);
        $res      = $this->postJsonData($url, $data);

        if ($res['status'] === 200) {
            $shipment_res = new model\Shipment_res();
            $cast         = $this->castClass($shipment_res, $res['response']);
            return $cast;
        } else {
            return array('error_code' => $res['status'], "err_message" => $res['response']->error);
        }
    }
    ### API CALL ###

    public function getData($url, $param = null)
    {
        $url  = self::API_URL . $url;
        $curl = new Curl\Curl();

        $this->cUrlOption($curl);

        $result = $curl->get($url, $param);

        $response = json_decode($result->response);
        return array(
            'status'   => $result->http_status_code,
            'response' => $response,
        );

    }

    public function postJsonData($url, $json)
    {
        $url  = self::API_URL . $url;
        $curl = new Curl\Curl();
        $this->cUrlOption($curl);
        $result   = $curl->post($url, $json);
        $response = json_decode($result->response);
        return array(
            'status'   => $result->http_status_code,
            'response' => $response,
        );
    }

    public function cUrlOption($curl)
    {
        $curl->setOpt(CURLOPT_CONNECTTIMEOUT, 30);
        $curl->setOpt(CURLOPT_TIMEOUT, 30);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
        $curl->setOpt(CURLOPT_HEADER, true);
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setHeader('apiversion', self::API_VER);
        $curl->setHeader('userid', $this->userid);
        $curl->setHeader('token', $this->token);
        $curl->setHeader('content-type', 'application/json');
    }

    public function castClass($destination, \stdClass $sourceObject)
    {
        $sourceReflection = new \ReflectionObject($sourceObject);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $name = $sourceProperty->getName();
            $destination->Set($name, $sourceObject->$name);
        }
        return $destination;
    }
}
