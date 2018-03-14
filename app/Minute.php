<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unit;

class Minute extends Unit
{
    protected $symbol = "min";
    protected $siunit = "s";
    protected $unitValue = 60;
}
