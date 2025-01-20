<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use App\Models\CompanyAddress;

class ShipLogicService
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        // $this->apiUrl = env('SaHIPLOGIC_API_URL', 'https://api.shiplogic.com');  // Replace with the actual ShipLogic API URL
        // $this->apiUrl = 'https://api.shiplogic.com';
        $this->apiUrl = 'http://localhost/appwise/api';
        // http://localhost/appwise/api/shop-owner/shop-details
        // $this->apiKey = 'a601d99c75fc4c64b5a64288f97d52b4';
        // $this->apiKey = '749b951424134149b2d2b5ac414e3f59';
        //env('SHIPLOGIC_API_KEY');  // Your API Key from ShipLogic
        //$this->apiKey = '6d841a65168143fc952836a27086abb2';//env('SHIPLOGIC_API_KEY');  // aslam test
        //
        // live: "676bc5d8709241288b881b8c1f41170d",
        // sandbox: "de725350f88d49358c964e6655c33ac1"
    }

    public function getShippingCharge($originZip, $destinationZip, $weight, $dimensions)
    {
        // $endpoint = '/shipping/charge';  // Replace with the actual API endpoint for shipping charge
        $endpoint = '/shop-owner/shop-details';  // Replace with the actual API endpoint for shipping charge
        $company_address = CompanyAddress::where('id', '1')->first();
        $payload = array(
            'collection_address' => array(
                "type" => "business",
                "company" => $company_address['name'],
                "street_address" => $company_address['address'],
                "local_area" => $company_address['city'],
                "city" => $company_address['city'],
                // "code" => "4051",
                "zone" => "",
                "country" => "ZA",
                'origin_zip' => $company_address['pincode'],
            ),

            "collection_contact" => array(
                "name" => "morne",
                "mobile_number" => "",
                "email" => "morne@123ecommerce.co.za"
            ),
            // 'delivery_address' => array('destination_zip' => $destinationZip),
            'delivery_address' => $destinationZip,

            // 'delivery_address' => array(
            //     "type" => "residential",
            //     "company" => "",
            //     "street_address" => "104 Valley View Rd, Escombe Queensburgh",
            //     "local_area" => "",
            //     "city" => "Durban",
            //     "country" => "ZA",
            //     "code" => "4093"
            // ),

            // 'delivery_address' => "",  // Weight in appropriate units (kg or lbs)
            // 'parcels' => array(
            //     array(
            //     "submitted_length_cm" => 80,
            //     "submitted_width_cm"  => 80,
            //     "submitted_height_cm" => 20,
            //     "submitted_weight_kg" => $weight
            //     ),  // Dimensions: ['length' => x, 'width' => y, 'height' => z]
            // )
            'parcels' =>  $dimensions
        );
        //https://api-docs.bob.co.za/shiplogic#POST-Getting%20rates

        // $payload = json_encode($payload);

        // print_r($payload);
        // die;

        try {
            $response = $this->client->post($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }

            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }

    public function createShippment($delivery_address, $delivery_contact, $parcels, $orderId)
    {
        // dd($parcels);

        //https://api-docs.bob.co.za/shiplogic#POST-Getting%20rates
        // $endpoint = '/shipping/charge';  // Replace with the actual API endpoint for shipping charge
        $endpoint = '/v2/shipments';  // Replace with the actual API endpoint for shipping charge
        $currentDate = Carbon::now();
        $company_address = CompanyAddress::where('id', '1')->first();

        $payload = [
            // "collection_address" => [
            //     "type" => "business",
            //     "company" => "https://123ecommerce.co.za/",
            //     "street_address" => "116 Lois Avenue",
            //     "local_area" => "",
            //     "city" => "",
            //     // "code" => "10001",
            //     "zone" => "",
            //     "country" => "ZA",
            //     'origin_zip' => "10001"

            // ],
            "collection_address" => [
                "type" => "business",
                "company" => "https://123ecommerce.co.za/",
                "street_address" => $company_address['address'],
                "local_area" => $company_address['city'],
                "city" => $company_address['city'],
                // "code" => "4051",
                "zone" => "",
                "country" => $company_address->country,
                'origin_zip' => $company_address['pincode'],
            ],
            "collection_contact" => [
                // "name" => "Cornel Rautenbach",
                // "mobile_number" => "",
                // "email" => "info@appwise.co.za"
                "name" => $company_address->company_name,
                "mobile_number" => (string) $company_address->mobile_number,
                "email" => $company_address->company_email
            ],
            "delivery_address" => $delivery_address,
            "delivery_contact" => $delivery_contact,
            "parcels" => $parcels,
            "opt_in_rates" => [],
            "opt_in_time_based_rates" => [
                76
            ],
            // "special_instructions_collection" => "This is a test shipment - DO NOT COLLECT", // if live "courier shipment"
            // "special_instructions_delivery" => "This is a test shipment - DO NOT DELIVER", // if live "courier shipment"
            "special_instructions_collection" => "courier shipment",
            "special_instructions_delivery" => "courier shipment",
            "declared_value" => 1100,
            "collection_min_date" =>  $currentDate->timezone('UTC')->format('Y-m-d\TH:i:s.v\Z'),
            "collection_after" => "08:00",
            "collection_before" => "16:00",
            "delivery_min_date" => $currentDate->addDay(3)->timezone('UTC')->format('Y-m-d\TH:i:s.v\Z'),
            "delivery_after" => "10:00",
            "delivery_before" => "17:00",
            "custom_tracking_reference" => "",
            "customer_reference" => '' . $orderId . '',
            "service_level_code" => "ECO",
            "mute_notifications" => false
        ];

        // $payload = json_encode($payload);
        // print_r($payload);
        // die;

        try {
            $response = $this->client->post($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }

            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }

    public function createReturnShippment($delivery_address, $delivery_contact, $collection_address, $collection_contact, $parcels, $orderId)
    {
        // dd($parcels);

        //https://api-docs.bob.co.za/shiplogic#POST-Getting%20rates
        // $endpoint = '/shipping/charge';  // Replace with the actual API endpoint for shipping charge
        $endpoint = '/v2/shipments';  // Replace with the actual API endpoint for shipping charge
        $currentDate = Carbon::now();
        $payload = [
            "collection_address" => $collection_address,
            "collection_contact" => $collection_contact,
            "delivery_address" => $delivery_address,
            "delivery_contact" => $delivery_contact,
            "parcels" => $parcels,
            "opt_in_rates" => [],
            "opt_in_time_based_rates" => [
                76
            ],
            // "special_instructions_collection" => "This is a test shipment - DO NOT COLLECT", // if live "courier shipment"
            // "special_instructions_delivery" => "This is a test shipment - DO NOT DELIVER", // if live "courier shipment"
            "special_instructions_collection" => "courier shipment",
            "special_instructions_delivery" => "courier shipment",
            "declared_value" => 1100,
            "collection_min_date" => $currentDate->timezone('UTC')->format('Y-m-d\TH:i:s.v\Z'),
            "collection_after" => "08:00",
            "collection_before" => "16:00",
            "delivery_min_date" => $currentDate->addDay(3)->timezone('UTC')->format('Y-m-d\TH:i:s.v\Z'),
            "delivery_after" => "10:00",
            "delivery_before" => "17:00",
            "custom_tracking_reference" => "",
            "customer_reference" => '' . $orderId . '',
            "service_level_code" => "ECO",
            "mute_notifications" => false
        ];
        // $payload = json_encode($payload);
        // print_r($payload);die;

        try {
            $response = $this->client->post($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }

            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }

    /*
    *@getShippingLabel
     */
    public function getShippingLabel($shipping_id)
    {
        $endpoint = '/v2/shipments/label?id=' . $shipping_id;  // Replace with the actual API endpoint for shipping charge
        try {
            $response = $this->client->get($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                // 'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }

            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }
    /*
    * @getShippingStickers
    *
     */
    public function getShippingStickers($shipping_id)
    {
        $endpoint = '/v2/shipments/label/stickers?id=' . $shipping_id;  // Replace with the actual API endpoint for shipping charge
        try {
            $response = $this->client->get($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                // 'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }

            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }

    /*
    *@ shipments Tracking
     */
    public function getShippingTracking($tracking_reference)
    {

        $endpoint = '/v2/shipments?tracking_reference=' . $tracking_reference;  // Replace with the actual API endpoint for shipping charge
        try {
            $response = $this->client->get($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                // 'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }

            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }
    /**
     * @ Cancelshipping
     *
     * */
    public function cancelShipment($tracking_reference)
    {
        $endpoint = '/v2/shipments/cancel';  // Replace with the actual API endpoint for shipping charge

        $payload = array("tracking_reference" => $tracking_reference);


        try {
            $response = $this->client->post($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }
            return ['error' => 'Failed to retrieve shipping charge'];
        } catch (RequestException $e) {
            // Handle request errors
            return ['error' => $e->getMessage()];
        }
    }
}
