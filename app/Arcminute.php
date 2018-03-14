<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unit;

class Arcminute extends Unit
{
    protected $symbol = "'";
    protected $siunit = "rad";
    protected $unitValue = M_PI/10800;
}
