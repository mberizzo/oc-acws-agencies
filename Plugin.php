<?php namespace Mberizzo\AcWsLocation;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'AC WS Locations',
            'description' => 'Provides features used by the provided demonstration theme.',
            'author'      => 'Matias Berizzo',
            'icon'        => 'icon-map-marker'
        ];
    }

    public function registerComponents()
    {
        return [
            'Mberizzo\Acwslocation\Components\LocationList' => 'locationList'
        ];
    }

    public function registerSettings()
    {
        return [
            'ac_ws_locations' => [
                'label' => 'AC WS Locations',
                'description' => 'Config API url and access token.',
                'icon' => 'icon-map-marker',
                'class' => 'Mberizzo\Acwslocation\Models\Settings',
                'order' => 500,
            ],
        ];
    }
}
