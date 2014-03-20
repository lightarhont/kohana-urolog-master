<?php defined('SYSPATH') or die('No direct script access.');

$result = function() use ($post) {
 
 $vpost = Validation::factory($post);
 $paramsrules = Kohana::$config->load('rules/users');

 $vpost
   ->rule('username', 'not_empty')
   ->rule('username', 'alpha_dash', array(':value', TRUE))
   ->rule('username', 'min_length', array(':value', $paramsrules['username']['min_length']))
   ->rule('username', 'max_length', array(':value', $paramsrules['username']['max_length']))
   ->rule('fullname', 'not_empty')
   ->rule('fullname', 'alpha_dash', array(':value', TRUE))
   ->rule('fullname', 'min_length', array(':value', $paramsrules['fullname']['min_length']))
   ->rule('fullname', 'max_length', array(':value', $paramsrules['fullname']['max_length']))
   ->rule('email', 'not_empty')
   ->rule('email', 'email')
   ->rule('password', 'not_empty')
   ->rule('password', 'alpha_numeric', array(':value', TRUE))
   ->rule('password', 'min_length', array(':value', $paramsrules['password']['min_length']))
   ->rule('password', 'max_length', array(':value', $paramsrules['password']['max_length']))
   ->rule('passwordconfirm', 'matches', array(':validation', 'passwordconfirm', 'password'));
   
   if($vpost->check()) :
    $user = ORM::factory('User')
     ->where('username', '=', $vpost['username'])
     ->or_where('email', '=', $vpost['email'])
     ->find();
    if($user->loaded()) :
     $erroruser = array('username' => 'Пользователь/email существует',
                        'email' => 'Пользователь/email существует');
     return json_encode($erroruser);
    else :
     return 'success';
    endif;
   else :
    return json_encode($vpost->errors('comments'));
   endif;
 
 return var_dump($post);
};