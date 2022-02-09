<?php namespace Mberizzo\Acwsagencies\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'ac_ws_agencies_settings';

    public $settingsFields = 'fields.yaml';
}
