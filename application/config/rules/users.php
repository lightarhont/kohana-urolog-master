<?php defined('SYSPATH') or die('No direct script access');

return array('username' => array(
                                 'min_length' => 3,
                                 'max_length' => 20
                                 ),
             'fullname' => array(
                                 'min_length' => 3,
                                 'max_length' => 20
                                 ),
             'email'    => array(
                                 'max_length' => 20
                                 ),
             'password' => array('min_length' => 5,
                                 'max_length' => 20
                                 )
             );