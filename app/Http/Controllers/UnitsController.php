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

    /**
     * function to get replace value for the string
     * @param Unit $unitInstance
     * @param String $type - either "value" or "name"
     * @return String
     */
    function getReplaceValue($unitInstance, $type = "value") {
        if($type == "name") {
            return $unitInstance->getSiUnit();
        }

        return $unitInstance->getUnitValue();
    }

    /**
     * function to get replace string
     * @param Array $array
     * @param String $string - input string for replace
     * @param String $type - either "value" or "name"
     * @param String $returnType - either "value" or "name"
     * @return String
     */
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

    /**
     * function to replace value in a string using exact match pattern
     * @param String $search - string to search
     * @param String $replace - string to replace
     * @param String $string - input string
     * @return String
     */
    function exact_replace($search, $replace, $string) {
        $searchString = "/\b(".$search.")\b/";
        if(in_array($search, array('°',"''",'"'))) {
            return str_replace($search, $replace, $string);
        }

        return preg_replace($searchString, $replace, $string);
    }

}
