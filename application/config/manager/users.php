<?php defined('SYSPATH') or die('No direct script access');

const MAINPATH = 'Manager/Users/';

return array(
             'userslist' => array(
                                  'path' => MAINPATH.'Users/TableList/',
                                  'orm'  => 'User',
                                  'funcprefix' => 'user',
                                  'listlimit' => 3
                                  ),
             'adduser'   => array(
                                  'path' => MAINPATH.'Users/AddUser/',
                                  'orm'  => 'User'
                                  ),
             'edituser'  => array('path' => MAINPATH.'Users/EditUser/',
                                  'orm'  => 'User'
                                  )
            );