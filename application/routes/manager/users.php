<?php defined('SYSPATH') or die('No direct script access.');

$defaultsparam = array('controller' => 'Users');

$uri_prefix = 'manager/users/';

Route::set('users', $uri_prefix.'userslist(/page-<page>).html', array('page' => '[0-9]'))
        ->defaults($defaults('userslist'));

Route::set('usersnew', $uri_prefix.'newuser.html')
        ->defaults($defaults('adduser'));

Route::set('usersedit', $uri_prefix.'edituser(/itemid-<itemid>).html', array('itemid' => '[0-9]+'))
        ->defaults($defaults('edituser'));