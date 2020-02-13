<?php
namespace Centurion\Helpers;

class UI
{
    // get page title
    public static function pageTitle($title = '')
    {
        static $constantTitle;

        if ($title != '')
        {
            $constantTitle = $title;
        }

        if (!is_null($constantTitle))
        {
            return ucfirst($constantTitle);
        }

        // get current view
        return ucfirst(uri()->view);
    }

    // get breadcrumb
    public static function breadcrumb()
    {
        $list = [];

        // get url
        $url = uri()->paths();

        // build anchorTag
        $anchorTag = function(string $element, $theEnd) : string
        {
            if (!$theEnd)
            {
                return '<a href="'.url($element).'">'.$element.'</a>';
            }

            return strtolower($element);
        };

        // build list
        foreach ($url as $index => $element)
        {
            $theEnd     =  $index == (count($url) - 1);
            $className  =  $theEnd ? 'breadcrumb-item active' : 'breadcrumb-item';
            $caption    =  $theEnd ? self::pageTitle() : $element;

            $list[] = '<li class="'.$className.'">'.$anchorTag($element, $theEnd).'</li>';
        }

        return implode("\n", $list);
    }
}