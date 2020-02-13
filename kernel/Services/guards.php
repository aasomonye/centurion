<?php

$kernel->globalGuards(function(Guards $guard)
{
    // load guards
    $guard->apply('sessionLogin@hasSessionToken');
    $guard->apply('Template@switchTemplate');
});