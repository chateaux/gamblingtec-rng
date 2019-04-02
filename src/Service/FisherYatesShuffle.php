<?php
/**
 * The Fisher Yates shuffle, read more about it here
 * https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle
 */
namespace Application\Service;

class FisherYatesShuffle
{
    public static function shuffle(array $array) : array
    {
        for($i = 0; $i < sizeof($array); ++$i) {
            $r = GamblingTecRNG::getInteger(0, $i);
            $tmp = $array[$i];
            $array[$i] = $array[$r];
            $array[$r] = $tmp;
        }

        return $array;
    }
}
