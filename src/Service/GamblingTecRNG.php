<?php
/**
 * Copyright Sunseven NN,
 * E-Commerce Park, Willemstad, Curacao
 * To be used according to the prevailing terms and conditions
 * as set out in the discourse with Sunseven NV.
 */
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
