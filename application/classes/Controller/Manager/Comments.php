<?php defined('SYSPATH') or die('No direct script access.');

require_once(APPPATH.'classes/Controller/Manager/Mixins/Tablelist'.EXT);

class Controller_Manager_Comments extends Controller_Manager_Common {
    
 use tablelist;
 
 public function beforeclient()
 {
  $this->mainmenuact = 7;
  $this->configfile .= 'comments';
  
  $this->template->sitetitle .= 'Менеджер комментариев';
  View::set_global('header', 'МЕНЕДЖЕР КОММЕНТАРИЕВ:');
  View::set_global('uripath', 'manager/comments/');
 }
 
 public function action_commentslist()
 {
  $this->template->sitetitle .= '::Список комментариев';
  $this->bildtablejs();
  $this->template->middle = 'this';
 }
 
 public function action_addcomment()
 {
  $this->template->middle = 'this';
 }
 
 public function action_editcomment()
 {
  $this->template->middle = 'this';
 }
 
 public function afterclient()
 {
    
 }

}