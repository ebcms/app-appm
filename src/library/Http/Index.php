<?php

declare(strict_types=1);

namespace App\Ebcms\Appm\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Ebcms\Template;

class Index extends Common
{
    public function get(
        App $app,
        Template $template
    ) {
        $installed_file = $app->getAppPath() . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'composer' . DIRECTORY_SEPARATOR . 'installed.json';
        $installed = json_decode(file_get_contents($installed_file), true);
        $packages = [];
        foreach ($installed['packages'] as $pkg) {
            if ($pkg['type'] == 'ebcms-app') {
                $pkg['_disabled'] = !isset($app->getPackages()[$pkg['name']]);
                if ($pkg['_disabled']) {
                    $pkg['_enable'] = 1;
                } else {
                    $pkg['_disable'] = 1;
                }
                $packages[$pkg['name']] = $pkg;
            }
        }
        foreach ($packages as &$package) {
            if ($package['_disabled']) {
                foreach ($package['require'] as $name => $version) {
                    if (isset($packages[$name]) && $packages[$name]['_disabled']) {
                        $package['_enable'] = 0;
                        $package['_enable_name'] = $name;
                        break;
                    }
                }
            } else {
                foreach ($packages as $pkg) {
                    if (!$pkg['_disabled'] && isset($pkg['require'][$package['name']])) {
                        $package['_disable'] = 0;
                        $package['_disable_name'] = $pkg['name'];
                        break;
                    }
                }
            }
        }
        $packages['ebcms/appm']['_disable'] = 0;
        $packages['ebcms/appm']['_disable_name'] = '此项不能禁用';
        $packages['ebcms/appm']['_enable'] = 1;
        return $template->renderFromFile('index@ebcms/appm', [
            'packages' => $packages,
        ]);
    }
}
