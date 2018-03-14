<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unit;

class Hectare extends Unit
{
    protected $symbol = "ha";
    protected $siunit = "m^2";
    protected $unitValue = 10000;
}
