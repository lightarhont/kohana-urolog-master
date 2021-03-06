<?php defined('SYSPATH') or die('No direct script access');

return array(
 'native' => array(
 'name' => 'sitecookie',
 'lifetime' => 43200,
 ),
 'cookie' => array(
 'name' => 'sitecookie',
 'encrypted' => TRUE,
 'lifetime' => 43200,
 ),
 'database' => array(
 'name' => 'sitecookie',
 'encrypted' => TRUE,
 'lifetime' => 43200,
 'group' => 'default',
 'table' => 'sessions',
 'columns' => array(
 'session_id' => 'session_id',
 'last_active' => 'last_active',
 'contents' => 'contents'
 ),
 'gc' => 500,
 ),
);