<?php

namespace App\Hps;

use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;

class eView extends Base
{
    static $clientVersion = '8686';

    public function routeCurrent(): ?string
    {
        return Route::current()->getName();
    }

    public function setView($dir, $template, $var = [], $render = false)
    {
        $localtion = '';
        if ($dir) {
            \View::addLocation($dir);
            $localtion = '/views/';
        }
        if (!isset($var['THEME_EXTEND'])) {
            $var['THEME_EXTEND'] = 'backend';
        }
        $var['router_current_name'] = $this->routeCurrent();
        $var['auth'] = auth()->user();
        $agent = new Agent();
        $var['agent'] = $agent;
        $view = view($localtion . $template, $var);
        if ($render) {
            return $view->render();
        }
        return $view;
    }

    public function notfound($id = 0): \Illuminate\Http\RedirectResponse
    {
        return redirect(route($this->routeCurrent()), 301, [
            'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0, private'
        ])->withErrors(($id > 0 ? 'ID: '.$id : '').' đã bị xóa hoặc không tồn tại');
    }

    public function notfoundClient($id = 0): \Illuminate\Http\RedirectResponse
    {
        return redirect(route('fe.home'), 301, [
            'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0, private'
        ])->withErrors(($id > 0 ? 'ID: '.$id : '').' đã bị xóa hoặc không tồn tại');
    }

}
