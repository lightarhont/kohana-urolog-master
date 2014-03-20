<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Common {
	
    public function action_index() {
      $javascriptcustom = "var ef='fade';
$(document).ready(function() { 
$('#s1').cycle(ef); 


$('#pause_button').click(function(){
$('#s1').cycle('pause');
								 });
$('#resume_button').click(function(){
$('#s1').cycle('resume');
								 });
});";  
      $this->pageproccesor('0', $javascriptcustom);
      $middle = View::factory('Public/Middle/Indexpage');
      $lc = new Lcsblockmodule;
      $middle->latestcomments = $lc->Latestcomments();
      $lb = new Lbsblockmodule;
      $middle->latestblogs = $lb->latestblogs();
      $this->template->middle = $middle;
      
    }

}

require_once APPPATH.'classes/Blockmodules/Latestblogs'.EXT;
require_once APPPATH.'classes/Blockmodules/Latestcomments'.EXT;