<?php

namespace App\Controller;

use Bootlace\Controller;

class Test extends Controller
{
    public function handle(): string
    {
        return $this->render('test');
    }
}
