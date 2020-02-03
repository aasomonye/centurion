<?php
namespace Moorexa;

ob_start();

// start session here
session_start();

// include system path
include_once 'sysPath.php';

// Set custom paths
SysPath::init('HOME', 'root');

// establish path
SysPath::app('controller');
SysPath::root('lab', 'lab');
SysPath::root('components', 'components');
SysPath::root('platform', 'platforms');
SysPath::components([
	'partial' => 'Partials',
	'directives' => 'Directives'
]);
SysPath::platform([
	'web_platform' => 'web',
	'api_platform' => 'api'
]);
SysPath::kernel();
SysPath::kernel([
	'servicemanager' => 'Service-Manager',
	'config' => 'Config',
	'extra' => 'Extra',
	'services' => 'Services',
	'konsole' => 'Console'
]);
SysPath::public();
SysPath::utility();
SysPath::public([
	'helper' => 'Helper',
	'errors' => 'Errors',
	'assets' => 'Assets',
	'css' => 'Assets/Css',
	'js' => 'Assets/Js',
	'media' => 'Assets/Media',
	'image' => 'Assets/Images'
]);
SysPath::system([
	'db'   => 'DB',
	'inc'  => 'Inc',
	'lib'  => 'Lib',
	'core' => 'Core',
	'abstract' => 'Abstract',
	'interface' => 'Interface',
]);
SysPath::utility([
	'exceptions' => 'Exceptions',
	'plugin' => 'Plugins',
	'provider' => 'Providers',
	'middleware' => 'Middlewares',
	'console' => 'Console',
	'authentication' => 'Authentication',
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
