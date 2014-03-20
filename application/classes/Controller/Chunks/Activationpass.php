<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Activationpass extends Controller {

 public function action_activation() {
  
  $url_key = $this->request->param('url_key', 'none');
  
  $resetpassmodel  = ORM::factory('Resetpassorm');
  
  $find            = $resetpassmodel 
	               ->where('url_key', '=', $url_key)
	               ->find();
				   
  if (!empty($find->id) && isset($find->id)) {
   
   $usermodel   = ORM::factory('Usersite', $find->user_id);
                $usermodel
                ->set('password', hash_hmac('sha256', $find->newpassword, 'wigbble'))
                ->update();
   
   $this->redirect('utilites/newpassword/');
   
  }
  else {
  
   $this->redirect('utilites/noneuser/');
  
  }
  
 }

}