<?php

namespace Mberizzo\Acwsagencies\Classes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Mberizzo\Acwsagencies\Models\Settings;

class WSAgencyList
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

        return App::call(new AgencyListDecorator($list['data']));
    }
}
