<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Fotoid extends Controller_Ajaxauth {
 
 public function action_showfoto() {
 
  
  
  $id = $this->request->param('id', '1');
  $table = ORM::factory('Foto');
  $query = $table
           ->where('id', '=' ,$id)
		   ->find();
		   
  
  if(!$query->loaded())
  {
	throw new HTTP_Exception_404('Фото не найдено');
  }
  
  $componentid = 'foto='.$query->id;
  
  $total = Request::factory('countcomments/'.$componentid)->execute();
  
  $sitetitle = Kohana::$config->load('configsite.sitetitle').'::';
  $sitetitle = $sitetitle.'Фото::'.$query->name;
  
  if($this->auth->logged_in()) {

  $data = array(
				'logged_in'      => '1',
				'full_img'       => $query->full_img,
		                'pagetitle'      => $sitetitle,
				'name'           => $query->name,
				'description'    => $query->description,
				'componentid'    => $componentid,
				'userid'         => $this->user->id,
				'total'          => $total
  
  );
  
  }
  else {
   
 $data = array(
                                'logged_in'      => '0',
				'full_img'       => $query->full_img,
		                'pagetitle'      => $sitetitle,
				'name'           => $query->name,
				'description'    => $query->description,
				'componentid'    => $componentid,
				'total'          => $total
  
  );
   
  }
  $body = View::factory('Public/Foto', $data);
  
  $this->template->body = $body;
  
 }
 
}