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

        return $this->decorate($list['data']);
    }

    private function decorate($list)
    {
        $agencies = collect($list)->map(function ($agency) {
            return [
                'lat' => data_get($agency, 'direccion.latitud'),
                'lng' => data_get($agency, 'direccion.longitud'),
                'city' => data_get($agency, 'direccion.localidad.nombre'),
                'province' => data_get($agency, 'direccion.provincia.nombre'),
                'title' => data_get($agency, 'nombre'),
                'link_facebook' => data_get($agency, 'facebook'),
                'address' => $this->getAddress($agency),
                'phone' => data_get($agency, 'telefonoCelular2'),
            ];
        });

        return $agencies->filter(function ($agency) {
            return $agency['lat'] && $agency['lng'];
        })->all();
    }

    private function getAddress($agency)
    {
        $location = data_get($agency, 'direccion.localidad.nombre');
        $province = data_get($agency, 'direccion.provincia.nombre');
        $street = data_get($agency, 'direccion.calle');

        return "{$street}, {$location}, {$province}";
    }
}
