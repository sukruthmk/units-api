<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unit;

class Hour extends Unit
{
    protected $symbol = "h";
    protected $siunit = "s";
    protected $unitValue = 3600;
}
