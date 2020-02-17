<?php
/** @noinspection ALL */

namespace Moorexa;

ob_start();

// start session here
session_start();

// include system path
include_once 'sysPath.php';

/**
 * extablish base path for root directory
 */
SysPath::init('HOME', 'root');

/**
 * extablish base path for lab directory
 */
SysPath::root('lab', 'lab');

/**
 * extablish base path for components directory
 */
SysPath::root('components', 'component');

/**
 * extablish base path for platform directory
 */
SysPath::root('platform', 'platform');

/**
 * add path for folders in the components directory
 */
SysPath::components([
    'partial' => 'Partials',
    'directives' => 'Directives',
    'templates' => 'Template'
]);

/**
 * add path for folders in the platform directory
 */
SysPath::platform([
    'web_platform' => 'web',
    'api_platform' => 'api'
]);

/**
 * extablish base path for kernel directory
 */
SysPath::kernel();

/**
 * add path for folders in the kernel directory
 */
SysPath::kernel([
    'servicemanager' => 'Service-Manager',
    'config' => 'Config',
    'extra' => 'Extra',
    'services' => 'Services',
    'konsole' => 'Console'
]);

/**
 * extablish base path for public directory
 */
SysPath::definePathFunc('public');

/**
 * extablish base path for utility directory
 */
SysPath::utility();

/**
 * add path for folders in the public directory
 */
SysPath::definePathFunc('public', [
    'helper' => 'Helper',
    'errors' => 'Errors',
    'assets' => 'Assets',
    'css' => 'Assets/Css',
    'js' => 'Assets/Js',
    'media' => 'Assets/Media',
    'image' => 'Assets/Images'
]);

/**
 * extablish base path for system directory
 */
SysPath::system();

/**
 * add path for folders in the system directory
 */
SysPath::system([
    'db'   => 'DB',
    'inc'  => 'Inc',
    'lib'  => 'Lib',
    'core' => 'Core',
    'abstract' => 'Abstract',
    'interface' => 'Interface',
]);

/**
 * add path for folders in the utility directory
 */
SysPath::utility([
    'exceptions' => 'Exceptions',
    'plugin' => 'Plugins',
    'provider' => 'Providers',
    'middleware' => 'Middlewares',
    'console' => 'Console',
    'guards' => 'Guards',
    'storage' => 'Storage',
    'event' => 'Events'
]);

// command line surfing
SysPath::cliSurfing();

// include error class
include_once 'everythingErrors.php';

// define module path
define ('MODULE_PATH', PATH_TO_CORE . 'coreModule.php');

// define composer path
define ('COMPOSER', HOME . 'vendor/autoload.php');
