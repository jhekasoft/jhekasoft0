<?php

namespace Application\Model;

class Functions
{   
    public function pluralWord($number, $words = array('день', 'дня', 'дней')) {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $words[($number % 100 > 4 && $number % 100 < 20)? 2: $cases[min($number % 10, 5)]];
    }
}
