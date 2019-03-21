<?php
namespace Application\Service;

use Zend\Math\Rand;

class GamblingTecRNG
{
    public function getInteger(int $min, int $max)
    {
        return Rand::getInteger($min, $max);
    }

    public function getBoolean()
    {
        return Rand::getBoolean();
    }

    public function getFloat()
    {
        return Rand::getFloat();
    }

    public function getString($min, $charlist = null)
    {
        return Rand::getString($min, $charlist);
    }
}
