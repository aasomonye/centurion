<?php

namespace Centurion\Models;
use Moorexa\InputData\Rule;
/**
 * @package Input helper class
 * This call supplies input data to the view
 */
class Input
{
    private static $ruleData = null;

    // pass method
    public static function pass($modelData)
    {
        // add rule data
        self::$ruleData = $modelData;
    }

    // get rule data
    public static function get()
    {
        return self::$ruleData;
    }
}