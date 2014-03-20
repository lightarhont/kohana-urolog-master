<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Category extends Controller_Common {
	
 public function action_category() {
  
  $this->pageproccesor('6');
  
  $middle = View::factory('Public/Middle/Colons2');
  
  $middle->component = $this->catalogproducts();
  
  $cc = new ccblockmodule;
  $middle->blockmodules = $cc->show();
  
  $this->template->middle = $middle;
         
 }
 
 protected function catalogproducts() {
  
  $model = ORM::factory('Catalogorm');
  
  $results = $model->order_by('order')->find_all();
  
  $cataloglist = '<table class="catalogtable" cellpadding=0 cellspacing=0><tr class="header"><td class="col1">№</td><td class="col2">Название</td><td class="col3">Скачать</td></tr>';
  foreach($results as $result) {
   
   $colorrow = $result->id % 2;
   
   if(empty($result->content)) {
    $nolink = 1;
   }
   else {
    $nolink = 0;
   }
   
   $data = array('id' => $result->id,
		 'colorrow' => $colorrow,
		 'url' => $result->url,
		 'nolink' => $nolink, 
		 'title' => $result->title);
   $cataloglist .= View::factory('Public/Chunks/Cataloglist', $data);
  }
  $cataloglist .= '</table>';
  
  return $cataloglist;
 }

}

require_once APPPATH.'classes/Blockmodules/Categorycatalog'.EXT;