<?php namespace Kodermax\CallBack;

use System\Classes\PluginBase;

/**
 * CallBack Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'CallBack',
            'description' => 'No description provided yet...',
            'author'      => 'Kodermax',
            'icon'        => 'icon-leaf'
        ];
    }

}
