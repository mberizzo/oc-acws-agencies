<?php namespace Mberizzo\Acwslocation\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'ac_ws_location_settings';

    public $settingsFields = 'fields.yaml';
}
