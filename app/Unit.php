<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Minute;
use App\Arcminute;
use App\Arcsecond;
use App\Day;
use App\Degree;
use App\Hectare;
use App\Hour;
use App\Litre;
use App\Tonne;

class Unit extends Model
{
    protected $symbol;
    protected $siunit;
    protected $unitValue;

    static function getInstance($unitName) {
        switch ($unitName) {
            case 'minute': return new Minute();
            case 'hour': return new Hour();
            case 'day': return new Day();
            case 'degree': return new Degree();
            case 'arcminute': return new Arcminute();
            case 'arcsecond': return new Arcsecond();
            case 'hectare': return new Hectare();
            case 'litre': return new Litre();
            case 'tonne': return new Tonne();
            default: return false;
        }
    }

    function getSiUnit() {
        return $this->siunit;
    }

    function getUnitValue() {
        return $this->unitValue;
    }
}
