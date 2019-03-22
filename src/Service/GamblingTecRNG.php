<?php
namespace Application\Service;

use Zend\Math\Rand;

class GamblingTecRNG
{
    public static function getInteger(int $min, int $max)
    {
        return Rand::getInteger($min, $max);
    }

    public static function getBoolean()
    {
        return Rand::getBoolean();
    }

    public static function getFloat()
    {
        return Rand::getFloat();
    }

    public static function getString($min, $charlist = null)
    {
        return Rand::getString($min, $charlist);
    }
}
