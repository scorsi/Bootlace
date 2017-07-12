<?php

namespace App;

use Bootlace\Controller;

class Test extends Controller
{
    public function run(): string
    {
        return $this->render('test');
    }
}
