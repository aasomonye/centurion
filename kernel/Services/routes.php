<?php

use Moorexa\Route;
use Moorexa\Event;
use Moorexa\Registry;
use Moorexa\Bootloader;
use Moorexa\DB;
use Moorexa\Middleware;

/*
 ***************************
 * 
 * @ Route
 * info: Add your GET, POST, DELETE, PUT request handlers here. 
*/

Route::any('change-password-{activationcode}', ['activationcode' => '/([\S]+)/'], function($activationcode)
{
    return 'app/changePassword/'.$activationcode;
});
