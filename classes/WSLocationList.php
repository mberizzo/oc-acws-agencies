<?php

namespace Mberizzo\Acwslocation\Classes;

use GuzzleHttp\Client;
use Mberizzo\Acwslocation\Models\Settings;

class WSLocationList
{

    public function __invoke(Client $client, Settings $settings)
    {
        $response = $client->request('GET', $settings->get('api_url'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => $settings->get('api_token'),
            ],
        ]);

        $list = ['data' => []];

        if ($response->getStatusCode() === 200) {
            $list = json_decode($response->getBody()->getContents(), true);
        }

        return $list;
    }
}
