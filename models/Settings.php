<?php namespace Kodermax\CallBack\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{

    public $implement = [
        'System.Behaviors.SettingsModel'
    ];

    public $settingsCode = 'kodermax_callback_settings';

    public $settingsFields = 'fields.yaml';

}