<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NumberClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $number)
    {
        dd('Classifying numbers');
    }

    public function classify(Request $request)
    {
        $number = $request->input('number');

        if (!$number || !is_numeric($number)) {
            return response()->json([
                'number' => "This is not a number",
                "error" => true
            ],
                400,
                [],
                JSON_PRETTY_PRINT);
        }

        $isNumberEven = $this->isNumberEven($number);
        $isPrime = $this->isPrime($number);
        $isPerfectNumber = $this->isPerfectNumber($number);
        $isArmstrongNumber = $this->isNumberArmstrong($number);
        $funFact = $this->getFunFact($number);

        $properties = [];

        if($isArmstrongNumber && !$isNumberEven) {
            array_push($properties, "armstrong", "odd");
        }
        else if($isArmstrongNumber && $isNumberEven) {
            array_push($properties, "armstrong", "even");
        }
        else if(!$isArmstrongNumber && !$isNumberEven) {
            array_push($properties, "even");
        }
        else if(!$isArmstrongNumber && $isNumberEven) {
            array_push($properties, "even");
        }

        $response = [
            "number" => $number,
            "is_prime" => $isPrime,
            "is_perfect" => $isPerfectNumber,
            "properties" => $properties,
            "fun_fact" => $funFact
        ];

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    private function isNumberEven($number): bool{
        return $number % 2 === 0;
    }

    private function isPrime(int $number): bool
    {
        if ($number < 1) {
            return false;
        }

        if ($number === 2) {
            return true;
        }

        if ($number % 2 === 0) {
            return false;
        }

        for ($i = 3; $i <= sqrt($number); $i = $i + 2) {
            if ($number % $i === 0) {
                return false;
            }
        }
        return true;
    }

    private function isPerfectNumber(int $number): bool
    {
        $factors = [];
        for($i = 1; $i < $number; $i++) {
            if($number % $i === 0) {
                $factors[] = $i;
            }
        }

        if(array_sum($factors) === $number) {
            return true;
        }
        else{ return false;}

    }

    private function isNumberArmstrong(int $number):bool {
        $originalNumber = $number;
        $digitCount = 0;
        if($number === 0) {
            $digitCount = 1;
        }
        else{
            $temp = abs($number);
            while ($temp !== 0){
                $temp = intdiv($temp, 10);
                $digitCount++;
            }
        }

        $numDigits = $digitCount;
        $sum = 0;
        $tempValue = abs($originalNumber);

        while($tempValue != 0){
            $digit = $tempValue % 10;
            $sum += pow($digit, $numDigits);
            $tempValue = $tempValue / 10;
        }

        return $sum === abs($originalNumber);
    }

    private function getFunFact(int $number): string
    {
        $response = Http::get('http://numbersapi.com/' . $number . '/math');
        return $response->body();
    }
}
