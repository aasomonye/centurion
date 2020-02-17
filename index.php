<?php
/** @noinspection All */

namespace Moorexa {

    use Exception;

    /**
     * @package  Moorexa PHP Framework
     * @author   Fregatelab inc <Ifeanyi Amadi>. https://www.moorexa.com <amadiify.com>
     * @version  0.0.1
     */

    // enable gzip
    ob_start('ob_gzhandler');

    // include application paths
    include_once 'system/Inc/paths.php';

    // Check if CORE module really exists in the module folder
    try {

        if (file_exists(MODULE_PATH))
        {
            // require composer autoloader
            require_once COMPOSER;

            // require core module
            require_once MODULE_PATH;

            // engine class not found ?
            if ( !class_exists('Moorexa\Engine') ) { throw new \Exception('Moorexa Engine class not found in '.HOME.'system/core/'); }
        }

    } finally {
        // return instance
        return new Engine(); // app entry =>
    }
}

