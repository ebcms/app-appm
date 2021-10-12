<?php

declare(strict_types=1);

namespace App\Ebcms\Appm\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Ebcms\Request;

class Disable extends Common
{
    public function post(
        App $app,
        Request $request
    ) {
        $name = $request->post('name');

        $disabled_file = $app->getAppPath() . '/config/' . $name . '/disabled.lock';

        if ($request->post('disabled')) {
            if (!is_file($disabled_file)) {
                if (!is_dir(dirname($disabled_file))) {
                    mkdir(dirname($disabled_file), 0755, true);
                }
                touch($disabled_file);
            }
        } else {
            if (is_file($disabled_file)) {
                unlink($disabled_file);
            }
        }
        return $this->success('操作成功！');
    }
}
