<?php

$kernel->authentication(function(Authenticate $auth)
{
    // load authentication handlers
    $auth->apply('sessionLogin.auth@hasSessionToken');
});