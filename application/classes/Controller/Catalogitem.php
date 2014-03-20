<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Catalogitem extends Controller_Common {

 public function action_catalogitem() {
  
  $this->begin();
  
  $middle = View::factory('Public/Middle/Colons2');
  
  $middle->component = $this->catalogitem();
  
  $cc = new ccblockmodule;
  $middle->blockmodules = $cc->show();
  
  $this->template->middle = $middle; 
 }
 
 protected function catalogitem () {
  $catalogurl = $this->request->param('catalogurl', '1');
  
  $model = ORM::factory('Catalogorm'); 
  
  $result = $model->where('url', '=', $catalogurl)->find();
  
  if(!$result->loaded())
  {
	throw new HTTP_Exception_404('Запись не найдена');
  }
  
  $view = View::factory('Public/Chunks/Catalogitem');
  $view->title = $result->title;
  $view->content = $result->content;
  $view->date = $result->created;
  
  return $view;
 }
 
 protected function begin() {
    
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/category.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/jquery.arcticmodal-0.3.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/jquery.arcticmodal.theme.css" type="text/css" />';
  
  $js         = &$this->template->javascriptlib;
  $js         = '
<script type="text/javascript" src="/public/js/jquery-1.9.0.min.js"> </script>
<script src="/public/js/jquery.arcticmodal-0.3.min.js" charset="utf-8"> </script>';
  
  $this->template->menu  = $this->mainmenu(6);
 
 }

}

require_once APPPATH.'classes/Blockmodules/Categorycatalog'.EXT;