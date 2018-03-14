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

        // Use Regex to extract contents from pattern like (degree/minute)
        preg_match("/\((.*)\/(.*)\)/", $unitConversionString, $matches);
        $unitNameA = $matches[1];
        $unitNameB = $matches[2];

        // check if units are present in the request
        if(!empty($unitNameA) && !empty($unitNameB)) {
            $unitA = Unit::getInstance($unitNameA);
            $unitB = Unit::getInstance($unitNameB);

            if($unitA && $unitB) {
                $result["unit_name"] = $this->getUnitName($unitA, $unitB);
                $result["multiplication_factor"] = $this->getMultiplicationFactor($unitA, $unitB);
            }
        }

        // return json response
        return response()->json($result,  200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * function to get si units name for response like (rad/s)
     * @param  Unit $unitA
     * @param  Unit $unitB
     * @return String - formatted return value of units
     */
    public function getUnitName($unitA, $unitB) {
        $siUnitA = $unitA->getSiUnit();
        $siUnitB = $unitB->getSiUnit();
        return "(".$siUnitA."/".$siUnitB.")";
    }

    /**
     * function to get MultiplicationFactor
     * @param  Unit $unitA
     * @param  Unit $unitB
     * @return Float - divided value
     */
    public function getMultiplicationFactor($unitA, $unitB) {
        return $unitA->getUnitValue()/$unitB->getUnitValue();
    }
}
