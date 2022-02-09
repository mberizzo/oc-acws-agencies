<?php namespace Mberizzo\Acwsagencies\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\App;
use Mberizzo\Acwsagencies\Classes\WSAgencyList;

class AgencyList extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Agency List',
            'description' => 'Get Agencies from AC webservice.'
        ];
    }

    public function onRun()
    {
        $list = App::call(new WSAgencyList());

        $this->page['agencyList'] = $list;
    }
}
