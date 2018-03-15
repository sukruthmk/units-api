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

    // constants defined before
    public static $units = array("minute","hour","day","degree","arcminute","arcsecond","hectare","litre","tonne");
    public static $symbols = array("ha","min","h","d","°","'",'"',"L","t");

    /**
     * function to get unit instance by name
     * @param  String $unitName
     * @return Unit
     */
    static function getInstanceByName($unitName) {
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

    /**
     * function to get unit instance by symbol
     * @param  String $unitName
     * @return Unit
     */
    static function getInstanceBySymbol($unitName) {
        switch ($unitName) {
            case 'min': return new Minute();
            case 'h': return new Hour();
            case 'd': return new Day();
            case '°': return new Degree();
            case "'": return new Arcminute();
            case '"': return new Arcsecond();
            case 'ha': return new Hectare();
            case 'L': return new Litre();
            case 't': return new Tonne();
            default: return false;
        }
    }

    /**
     * function to get si unit value
     * @return String
     */
    function getSiUnit() {
        return $this->siunit;
    }

    /**
     * function to get unit value
     * @return String
     */
    function getUnitValue() {
        return $this->unitValue;
    }
}
