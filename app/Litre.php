<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unit;

class Litre extends Unit
{
    protected $symbol = "L";
    protected $siunit = "m^3";
    protected $unitValue = 0.001;
}
