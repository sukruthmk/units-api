<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unit;

class UnitsController extends Controller
{
    /**
     * function converts units to SI units based on the request
     * @param  Request $request
     * @return Response
     */
    public function convert(Request $request)
    {
        $unitConversionString = $request->get("units");
        $result = array();

        // check if units are present in the request
        if(!empty($unitConversionString)) {
            $result["unit_name"] = $this->getUnitName($unitConversionString);
            $result["multiplication_factor"] = $this->getMultiplicationFactor($unitConversionString);
        }

        // return json response
        return response()->json($result,  200, [], JSON_UNESCAPED_SLASHES);
    }

    public function getUnitName($unitConversionString) {
        $units = Unit::$units;
        $symbols = Unit::$symbols;

        // search for units
        $unitConversionString = $this->string_replace($units, $unitConversionString, "name", "name");

        // search for symbols
        $unitConversionString = $this->string_replace($symbols, $unitConversionString, "symbol", "name");

        return $unitConversionString;
    }

    public function getMultiplicationFactor($unitConversionString) {
        $units = Unit::$units;
        $symbols = Unit::$symbols;

        // search for units
        $unitConversionString = $this->string_replace($units, $unitConversionString, "name", "value");

        // search for symbols
        $unitConversionString = $this->string_replace($symbols, $unitConversionString, "symbol", "value");

        $result = eval('return '.$unitConversionString.';');
        return $result;
    }

    function getReplaceValue($unitInstance, $type = "value") {
        if($type == "name") {
            return $unitInstance->getSiUnit();
        }

        return $unitInstance->getUnitValue();
    }

    function string_replace($array, $string, $type, $returnType) {
        foreach ($array as $unit) {
            if(strpos($string, $unit) !== false){

                if($type == 'name') {
                    $unitInstance = Unit::getInstanceByName($unit);
                } else {
                    $unitInstance = Unit::getInstanceBySymbol($unit);
                }

                $string = $this->exact_replace($unit, $this->getReplaceValue($unitInstance, $returnType), $string);
            }
        }

        return $string;
    }

    function exact_replace($search, $replace, $string) {
        $searchString = "/\b(".$search.")\b/";
        return preg_replace($searchString, $replace, $string);
    }

    // /**
    //  * function to get si units name for response like (rad/s)
    //  * @param  Unit $unitA
    //  * @param  Unit $unitB
    //  * @return String - formatted return value of units
    //  */
    // public function getUnitName($unitA, $unitB) {
    //     $siUnitA = $unitA->getSiUnit();
    //     $siUnitB = $unitB->getSiUnit();
    //     return "(".$siUnitA."/".$siUnitB.")";
    // }

    // /**
    //  * function to get MultiplicationFactor
    //  * @param  Unit $unitA
    //  * @param  Unit $unitB
    //  * @return Float - divided value
    //  */
    // public function getMultiplicationFactor($unitA, $unitB) {
    //     return $unitA->getUnitValue()/$unitB->getUnitValue();
    // }
}
