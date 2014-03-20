<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Files extends Controller_Common {
	
 public function action_files() {
  
  $this->pageproccesor('5');
  
  $module = new Menublockmodule;
  
  $this->template->middle  = $module->custommodule();
         
 }
 
}

require_once APPPATH.'classes/Blockmodules/Menu'.EXT;