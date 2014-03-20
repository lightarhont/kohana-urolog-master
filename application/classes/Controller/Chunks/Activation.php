<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Activation extends Controller { 
 
 public function action_activation() {
  $userenc = $this->request->param('username', 'none');
  $user = Encrypt::instance()->decode($userenc);
  
  $usermodel   = ORM::factory('Usersite');
  $issetuser   = $usermodel
                ->where('username', '=', $user)
		        ->find();
  if(!empty($issetuser->id) && isset($issetuser->id)) {
  
   $usersmodel=ORM::factory('Role', 1)
   ->users
   ->where(DB::expr('`usersite`.`id`'), '=', $issetuser->id)
   ->find();
   
   if(empty($usersmodel->id)) {
    $insertrole=Model::factory('Insertroles')->addrolelogin($issetuser->id);
	
	$this->redirect('utilites/useract/');
   }
   else {
    $this->redirect('utilites/userisbeenact/');
   }
  }
  else {
   //Пользователь отсутствует в БД
   $this->redirect('utilites/noneuser/');
  }
 }
 
}