<?php namespace Mberizzo\AcWsAgencies;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'AC WS Agencies',
            'description' => 'Provides features used by the provided demonstration theme.',
            'author'      => 'Matias Berizzo',
            'icon'        => 'icon-map-marker'
        ];
    }

    public function registerComponents()
    {
        return [
            'Mberizzo\Acwsagencies\Components\AgencyList' => 'agencyList'
        ];
    }

    public function registerSettings()
    {
        return [
            'ac_ws_agencies' => [
                'label' => 'AC WS Agencies',
                'description' => 'Config API url and access token.',
                'icon' => 'icon-map-marker',
                'class' => 'Mberizzo\Acwsagencies\Models\Settings',
                'order' => 500,
            ],
        ];
    }
}
