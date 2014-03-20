<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Fotos extends Controller_Common {
 
 public function action_fotos() {
	
  $javascriptcustom = "function getalbums (page) {
  $('#cont').html('<div class=\"albums_foto_loading\"><img src=\"/public/images/loader.gif\" /></div>');
  $('#cont').load('/fotocategories/'+page);
  }
  
  function getcatidimages (page) {
  $('#cont2').html('<div class=\"albums_foto_loading\"><img src=\"/public/images/loader.gif\" /></div>');
  $('#cont2').load('/fotocategoryid/'+page);
  }
  
  function pages (page) {
  $('#pagesloading').html('<div class=\"pages_foto_loading\"><img src=\"/public/images/loader.gif\" /></div>');
  var obj = $.parseJSON($('#hiddencatid').text());
  $('#contentcategory').load('/fotocategorypages/'+obj.catid+'/'+page+'/'+obj.total);
  }
  
  ";
	
  $this->pageproccesor('3', $javascriptcustom);
	 
  $middle = View::factory('Public/Chunks/FotoPage');
  $middle->categories = Request::factory('Chunks_Foto/categories')->execute();
  $middle->category   = Request::factory('Chunks_Foto/defcategory')->execute();
  
  $this->template->middle  = $middle;
	 
 }
 
}