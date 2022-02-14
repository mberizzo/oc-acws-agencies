<?php

namespace Mberizzo\Acwsagencies\Classes;

class AgencyListDecorator
{

    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function __invoke()
    {
        return collect($this->list)->map(function ($agency) {
            return [
                'lat' => data_get($agency, 'direccion.latitud'),
                'lng' => data_get($agency, 'direccion.longitud'),
                'city' => data_get($agency, 'direccion.localidad.nombre'),
                'province' => data_get($agency, 'direccion.provincia.nombre'),
                'title' => data_get($agency, 'nombre'),
                'link_facebook' => data_get($agency, 'facebook'),
                'address' => $this->address($agency),
                'phone' => data_get($agency, 'telefonoCelular2'),
            ];
        })->reject(function ($agency) {
            return empty($agency['lat']) || empty($agency['lng']);
        })->all();
    }

    private function address($agency)
    {
        $location = data_get($agency, 'direccion.localidad.nombre');
        $province = data_get($agency, 'direccion.provincia.nombre');
        $street = data_get($agency, 'direccion.calle');

        return "{$street}, {$location}, {$province}";
    }
}
