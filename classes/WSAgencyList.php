<?php

namespace Mberizzo\Acwsagencies\Classes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Mberizzo\Acwsagencies\Models\Settings;

class WSAgencyList
{

    private $settings;
    private $client;

    public function __construct(Settings $settings, Client $client)
    {
        $this->settings = $settings;
        $this->client = $client;
    }

    public function __invoke()
    {
        $response = $this->client->request('GET', $this->settings->get('api_url'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => $this->settings->get('api_token'),
            ],
        ]);

        $list = ['data' => []];

        if ($response->getStatusCode() === 200) {
            $list = json_decode($response->getBody()->getContents(), true);
        }

        return (new AgencyListDecorator($list['data']))();
    }
}
