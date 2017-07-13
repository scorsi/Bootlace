<?php

namespace App;

use Bootlace\Controller;

class Test extends Controller
{
    public function handle(): string
    {
        return $this->render('test');
    }
}
