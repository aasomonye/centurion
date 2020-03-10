<?php
namespace Centurion\Helpers;

class UI
{
    // has delete request
    public static $hasDeleteRequest = false;

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
    public static function breadcrumb(array $breadcum = [])
    {
        $list = [];
        static $breadcumConfig;

        // get url
        $url = uri()->paths();

        // build anchorTag
        $anchorTag = function(string $element, $theEnd) : string
        {
            static $breadcum;

            if (!$theEnd)
            {
                if (is_null($breadcum))
                {
                    $breadcum = $element . '/';
                }
                else
                {
                    $breadcum .= $element . '/';
                }

                return '<a href="'.url($breadcum).'">'.$element.'</a>';
            }

            return strtolower($element);
        };

        if (count($breadcum) > 0)
        {
            $breadcumConfig = $breadcum;
        }

        // build list
        foreach ($url as $index => $element)
        {
            if (is_array($breadcumConfig))
            {
                if (isset($breadcumConfig[$element]))
                {
                    $element = $breadcumConfig[$element];
                }
            }

            $theEnd     =  $index == (count($url) - 1);
            $className  =  $theEnd ? 'breadcrumb-item active' : 'breadcrumb-item';
            $caption    =  $theEnd ? self::pageTitle() : $element;

            $list[] = '<li class="'.$className.'">'.$anchorTag($element, $theEnd).'</li>';
        }

        return implode("\n", $list);
    }

    // generate view path
    public static function generateViewPath(string $fallbackView, $view, $callback = null)
    {
        if ($view !== null)
        {
            // ensure listingtype exists
            $urlPath = $fallbackView. '/' . $view;
            
            if (Query::urlPathExists($urlPath))
            {
                if ($callback !== null && is_callable($callback))
                {
                    call_user_func_array($callback, [$view, $fallbackView]);
                }

                $fallbackView = $urlPath;
            }
        }

        return $fallbackView;
    }

    // confirm delete
    public static function confirmDelete($message = null)
    {
        static $messsageBox;

        // delete message
        $deleteConfirmed = false;

        if ($message == null && $messsageBox != null && !isset($_GET['confirmed']))
        {
            self::$hasDeleteRequest = true;
            return $messsageBox;
        }
        
        if ($message !== null)
        {
            $messsageBox = (object)[
                'text' => $message,
                'link' => url(lcfirst(uri()->pathAsSeen())) . '?confirmed=yes'
            ];
        }

        if (isset($_GET['confirmed']))
        {
            // hide delete request
            self::$hasDeleteRequest = false;
            $deleteConfirmed = true;
        }

        return $deleteConfirmed;
    }

    // Notification count for navigation
    public static function navigationNotification(int $count = 0) : string
    {
        $notification = '';

        if ($count > 0)
        {
            $notification = '<span class="badge badge-info right">'.$count.'</span>';
        }

        return $notification;
    }
}