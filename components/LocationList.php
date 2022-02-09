<?php namespace Mberizzo\Acwslocation\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\App;
use Mberizzo\Acwslocation\Classes\WSLocationList;

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
        $list = App::call(new WSLocationList());

        $this->page['locationList'] = $list;
    }
}
