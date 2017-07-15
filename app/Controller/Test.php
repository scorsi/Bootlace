<?php

namespace App\Controller;

use Bootlace\Controller;

class Test extends Controller
{
    public function handle(): string
    {
        $result = $this->query()->table('test')->select()->findAll();
        $this->assign('result', $result);
        return $this->render('test');
    }
}
