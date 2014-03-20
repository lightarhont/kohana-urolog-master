<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Insertroles extends Model {

 protected $_roles_users = 'roles_users';
 
 public function addrolelogin($id) {
  
  $query = DB::insert($this->_roles_users, array('user_id', 'role_id'))
         ->values(array($id, '1'));
		 
  $query->execute();
			
 }
  
}