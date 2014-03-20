<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Video extends Controller_Common {
	
 public function action_video() {
  
  $javascriptcustom = "function getalbums (page) {
  $('#cont').html('<div class=\"albums_foto_loading\"><img src=\"/public/images/loader.gif\" /></div>');
  $('#cont').load('/videocategories/'+page);
  }
  
  function getcatidimages (page) {
  $('#cont2').html('<div class=\"albums_foto_loading\"><img src=\"/public/images/loader.gif\" /></div>');
  $('#cont2').load('/videocategoryid/'+page);
  }
  
  function pages (page) {
  $('#pagesloading').html('<div class=\"pages_foto_loading\"><img src=\"/public/images/loader.gif\" /></div>');
  var obj = $.parseJSON($('#hiddencatid').text());
  $('#contentcategory').load('/videocategorypages/'+obj.catid+'/'+page+'/'+obj.total);
  }
  
  ";
	
  $this->pageproccesor('4', $javascriptcustom);
	 
  $middle = View::factory('Public/Chunks/FotoPage');
  $middle->categories = Request::factory('Chunks_Video/categories')->execute();
  $middle->category   = Request::factory('Chunks_Video/defcategory')->execute();
  
  $this->template->middle  = $middle;
         
 }

}