<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unit;

class Tonne extends Unit
{
    protected $symbol = "t";
    protected $siunit = "kg";
    protected $unitValue = 1000;
}
