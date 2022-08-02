<?php

namespace App\FizzBuzz;

/**
 * Class FizzBuzz
 * ToDo: implement the interface FizzBuzzInterface here
 * @package App\FizzBuzz
 */
class FizzBuzz implements FizzBuzzInterface
{
    public static function getSpecific(int $nr): string
    {
        if ($nr % 3 == 0 && $nr % 7 == 0 ) {
            return "FizzBuzz";
        }
        if ($nr % 3 == 0 ) {
            return "Fizz";
        }
        if ($nr % 7 == 0 ) {
            return "Buzz";
        }
        return strval($nr);
    }

    public static function getRange(int $start, int $end, int $step=null): array
    {
        $output = array();
        $step = (isset($step) ? $step  : 1 );
        for($i = $start; $i <= $end; $i = $i+$step) {
            $output[] = FizzBuzz::getSpecific($i);
        }
        return $output;
    }
}
