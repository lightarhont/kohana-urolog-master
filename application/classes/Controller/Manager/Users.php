<?php defined('SYSPATH') or die('No direct script access.');

require_once(APPPATH.'classes/Controller/Manager/Mixins/Tablelist'.EXT);

class Controller_Manager_Users extends Controller_Manager_Common {
    
 use tablelist;
 
 public function beforeclient()
 {
  
  $this->mainmenuact = 6;
  $this->configfile .= 'users';
  
  $this->template->sitetitle .= 'Менеджер пользователей';
  View::set_global('header', 'МЕНЕДЖЕР ПОЛЬЗОВАТАТЕЛЕЙ:');
  View::set_global('uripath', 'manager/users/');
  
 }
 
 public function action_userslist()
 {
  $this->template->sitetitle .= '::Список пользователей';
  $this->bildtablejs();
  if(!empty($_POST)):
   $this->posttablelist(Arr::map('trim', $_POST));
  endif;
  $page   = (int)$this->request->param('page', '1');
  $offset = $this->listlimit*$page-$this->listlimit;
  $model = ORM::factory($this->orm);
  $countblogslist = $model->count_all();
  $results = $model->offset($offset)->limit($this->listlimit)->find_all();
  $users = '';
  foreach($results as $result) :
   $model = ORM::factory($this->orm, $result->id);
   $roles = $model->roles->find_all();
   $userroles = '';
   foreach($roles as $role) :
    $userroles .= '<a href="#">'.$role->name.'</a> ';
   endforeach;
   $data = array('id'        => $result->id,
                 'username'  => $result->username,
                 'fullname'  => $result->fullname,
                 'email'     => $result->email,
                 'userroles' => $userroles,
                 'order'     => $result->order);
   $users .= View::factory($this->cvpath.'Tr', $data);
  endforeach;
  $pagination = Pagination::factory(array('total_items' => $countblogslist, 'items_per_page' => $this->listlimit, ));
  $middle = $this->tableview('СПИСОК ПОЛЬЗОВАТЕЛЕЙ', $users, $pagination);
  $this->template->middle = $middle;
 }
 
 public function action_adduser()
 {
   
   $this->template->sitetitle .= '::Новый пользователь';
   $this->template->jsfunc = View::factory($this->cvpath.'Js/Submit');
   $middle = View::factory($this->cvpath.'Index');
   $model = ORM::factory('Role');
   $tags  = $model->find_all();
   $taglist = '';
   foreach($tags as $tag) :
    $taglist .= '<div><input type="checkbox" name="role-'.$tag->id.'" /><span>'.$tag->name.'</span></div>';
   endforeach;
   $middle->roles = $taglist;
   $this->template->middle = $middle;
   
 }
 
 public function action_edituser()
 {
  $this->template->jsfunc = View::factory($this->cvpath.'Js/Submit');
  $itemid = (int)$this->request->param('itemid', '1');
  $result = ORM::factory('User', $itemid);
  $selected = $result->roles->find_all()->as_array();
  $model = ORM::factory('Role');
  $roles  = $model->find_all();
  $rolelist = '';
  foreach($roles as $role) :
   if(in_array($role->id, $selected)) :
    $rolelist .= '<div><input type="checkbox" checked="checked" name="role-'.$role->id.'" /><span>'.$role->name.'</span></div>';
   else :
    $rolelist .= '<div><input type="checkbox" name="role-'.$role->id.'" /><span>'.$role->name.'</span></div>';
   endif;
  endforeach;
  
  $data = array('id'       => $result->id,
                'username' => $result->username,
                'fullname' => $result->fullname,
                'email'    => $result->email,
                'roles'    => $rolelist);
  
  $middle = View::factory($this->cvpath.'Index', $data);
  $this->template->middle = $middle;
 }
 
 protected function insertrecorduser()
 {
  $post  = Arr::map('trim', $_POST);
  $model = ORM::factory($this->orm);
  $data = array('username' => $post['username'],
                'fullname' => $post['fullname'],
                'email'    => $post['email'],
                'password' => $post['password']);
  
  $arrayitems = function() use ($post) {
   
   $result = array();
   foreach($post as $key=>$value):
    if(preg_match('(^role-[0-9])', $key)) :
     $result[] = str_replace('role-', '', $key);
    endif;
   endforeach;
   return $result;
  };
  
  $model->values($data)->create();
  $arrayroles = $arrayitems();
  if(!empty($arrayroles)) :
   $model->add('roles', $arrayroles);
  endif;
 }
 
 protected function updaterecorduser()
 {
  $post  = Arr::map('trim', $_POST);
  $model = ORM::factory($this->orm, $post['id']);
  $data = array('username' => $post['username'],
                'fullname' => $post['fullname'],
                'email'    => $post['email']);
  
  if(!empty($post['password'])) :
   $data['password'] = $post['password'];
  endif;
  
  $arrayitems = function() use ($post) {
   
   $result = array();
   foreach($post as $key=>$value):
    if(preg_match('(^role-[0-9])', $key)) :
     $result[] = str_replace('role-', '', $key);
    endif;
   endforeach;
   return $result;
   
  };
  
  $model->values($data)->update();
  $arrayroles = $arrayitems();
  if(!empty($arrayroles)) :
   $model->remove('roles');
   $model->add('roles', $arrayroles);
  else :
   $model->remove('roles');
  endif;
  
 }
 
 public function afterclient()
 {
    
  $this->bildmenu();
  
 }

}