<?php
namespace AppBundle\Entity\Enum;

class BatteryTypeEnum
{

    const AAA = 'AAA';
    const AA = 'AA';
    const XF = 'XF';
    const XL = 'XL';
    const UNDEFINED = 'UNDEFINED';

    const ELEMENTS = [
        self::UNDEFINED => self::UNDEFINED,
        self::AAA => self::AAA,
        self::AA => self::AA,
        self::XF => self::XF,
        self::XL => self::XL,
    ];


}
