<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Qaptcha extends Controller {
 
 public function action_phpfile() {
 
//Cookie::set('user', 'ivan');

  $aResponse['error'] = false;
	
if(isset($_POST['action']) && isset($_POST['qaptcha_key']))
{
	//$_SESSION['qaptcha_key'] = false;
	$user = Cookie::delete('qaptcha_key');	
	
	if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha')
	{
		Cookie::set('qaptcha_key', $_POST['qaptcha_key']);
		//$_SESSION['qaptcha_key'] = $_POST['qaptcha_key'];
		$this->response->body(json_encode($aResponse));
	}
	else
	{
		$aResponse['error'] = true;
		$this->response->body(json_encode($aResponse));
	}
}
else
{
	$aResponse['error'] = true;
	$this->response->body(json_encode($aResponse));
} 
  
 }
 
}