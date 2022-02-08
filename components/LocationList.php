<?php namespace Mberizzo\Acwslocation\Components;

use Cms\Classes\ComponentBase;
use GuzzleHttp\Client;
use Mberizzo\Acwslocation\Models\Settings;

class LocationList extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Location List',
            'description' => 'Get location list from AC webservice.'
        ];
    }

    public function onRun()
    {
        $client = new Client;

        $response = $client->request('GET', Settings::get('api_url'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => Settings::get('api_token'),
            ],
        ]);

        $locations = ['data' => []];

        if ($response->getStatusCode() === 200) {
            $locations = json_decode($response->getBody()->getContents(), true);
        }

        $this->page['locationList'] = $locations['data'];
    }
}
