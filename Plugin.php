<?php namespace Kodermax\CallBack;

use System\Classes\PluginBase;
use Backend;
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
            'name'        => 'kodermax.callback::lang.plugin.name',
            'description' => 'kodermax.callback::lang.plugin.description',
            'author'      => 'Maksim Karpychev',
            'icon'        => 'icon-leaf'
        ];
    }
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'kodermax.callback::lang.settings.label',
                'description' => 'kodermax.callback::lang.settings.description',
                'category'    => 'Marketing',
                'icon'        => 'icon-cog',
                'class'       => 'Kodermax\CallBack\Models\Settings',
                'order'       => 100
            ]
        ];
    }
    public function registerNavigation()
    {
        return [
            'reviews' => [
                'label' => 'kodermax.callback::lang.menu.label',
                'url'   => Backend::url('kodermax/callback/requests'),
                'icon'        => 'icon-picture-o',
                'permissions' => ['kodermax.*'],
                'order'       => 500,
            ],
        ];
    }
    public function registerComponents()
    {
        return [
            'Kodermax\CallBack\Components\Request' => 'CallBackForm'
        ];
    }
    public function registerMailTemplates()
    {
        return [
            'kodermax.callback::emails.message' => 'kodermax.callback::lang.email.message',
        ];
    }
}
