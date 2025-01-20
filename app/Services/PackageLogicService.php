<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class PackageLogicService
{
    protected $client;
    protected $apiUrl;

    public function __construct()
    {
        $this->client = new Client();
        // $this->apiUrl = 'http://localhost/appwise/api';
    }

    public function sendPackageUpgradeData($domainUrl, $queryParams)
    {
        // $url = "http://localhost/appwise/api/shop-owner/update-package";
        $endpoint = "/api/shop-owner/update-package";
        $mainUrl = $domainUrl . $endpoint;

        // try {
        //     // API ko POST request bhejna with queryParams
        //     $response = Http::post($domainUrl . $endpoint, $queryParams);

        //     // Agar response successful hai, to JSON return karein
        //     if ($response->successful()) {
        //         return $response->json();
        //     }

        //     // Agar API fail hoti hai, error return karein
        //     return [
        //         'error' => true,
        //         'message' => 'Failed to call the API',
        //     ];
        // } catch (\Exception $e) {
        //     // Agar koi exception aaye to handle karein
        //     return [
        //         'error' => true,
        //         'message' => $e->getMessage(),
        //     ];
        // }
        //    echo $queryParams; die ;

        // try {
        // $response = $this->client->post($domainUrl . $endpoint, [
        //     'headers' => [
        //         // 'Authorization' => 'Bearer '  ,
        //         'Accept' => 'application/json',
        //         // 'Content-Type' => 'application/json',
        //     ],
        //     'json' => $queryParams,
        // ]);
        // print_r($response); die;

        // if ($response->getStatusCode() == 200) {
        //     return json_decode($response->getBody(), true);
        // }

        $curlHandle = curl_init($mainUrl);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curlHandle, CURLOPT_POST, true);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $queryParams);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

        $curlResponse = curl_exec($curlHandle);

        curl_close($curlHandle);

        // print_r($curlResponse); die;

        // return ['error' => 'Failed to retrieve shipping charge'];

        if ($curlResponse === false) {
            return ['error' => true, 'message' => 'Failed to retrieve shipping charge'];
        }

        return json_decode($curlResponse, true);
        // }
        //  catch (RequestException $e) {
        //     // Handle request errors
        //     return ['error' => $e->getMessage()];
        // }
    }

    public function saleReports($domainUrl, $queryParams)
    {
        // $url = "http://localhost/appwise/api/shop-owner/update-package";
        $endpoint = "/api/shop-owner/sales-reports";
        $mainUrl = $domainUrl . $endpoint;

        $curlHandle = curl_init($mainUrl);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curlHandle, CURLOPT_POST, true);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $queryParams);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

        $curlResponse = curl_exec($curlHandle);

        curl_close($curlHandle);

        // print_r($curlResponse); die;

        // return ['error' => 'Failed to retrieve shipping charge'];

        if ($curlResponse === false) {
            return ['error' => true, 'message' => 'Failed to retrieve shipping charge'];
        }

        return json_decode($curlResponse, true);
        // }
        //  catch (RequestException $e) {
        //     // Handle request errors
        //     return ['error' => $e->getMessage()];
        // }
    }
}
