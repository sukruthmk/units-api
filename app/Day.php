<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unit;

class Day extends Unit
{
    protected $symbol = "d";
    protected $siunit = "s";
    protected $unitValue = 86400;
}
