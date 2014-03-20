<?php defined('SYSPATH') or die('No direct script access.');

//Базовый контроллер 
abstract class Controller_Common extends Controller_Auth {

    public $template = NULL;
    
    //protected 
 
    public function before()
    {
        parent::before();
		$this->template = View::factory('Public/Template');
		
		$siteurl = Kohana::$config->load('configsite.url');
		$sitetitle = Kohana::$config->load('configsite.sitetitle').'::';
		
		$login = Request::factory('Chunks_Login/index')->execute();
		
		$this->template->siteurl = $siteurl;
		$this->template->sitetitle = $sitetitle;
		$this->template->description = '';
		$this->template->keywords = '';
		$this->template->stylesheet = '';
		$this->template->javascriptlib = '';
		$this->template->javascriptcustom = ''; 
		$this->template->login = $login;
    }
	
    public function after() {
	
	 $this->response->body($this->template);
	 parent::after();
    }
 
    protected function mainmenu($page=0) {
 
	$showmenu = ' <div class="menu"><ul class="mnu">';	
	
	for ($i=0; $i<7; $i++) {
	 if($page==$i) {
	  $showmenu .= '<li class="active">';
	  $showmenu .= Kohana::$config->load('mainmenu.'.$i.'.title');
	  $showmenu .= '</li>';
	 }
	 else {
	  $showmenu .= '<li><a href="';
	  $showmenu .= Kohana::$config->load('mainmenu.'.$i.'.url').'.html';
	  $showmenu .='">';
	  $showmenu .= Kohana::$config->load('mainmenu.'.$i.'.title');
	  $showmenu .= '</a></li>';
	 }
	 
	}
	
	$showmenu .= '</ul></div>';
	
	return $showmenu;
	
    }
    
    protected function pageproccesor($pageid, $javascriptcustom='') {
	 
	 //Заголовок страницы
	 $sitetitle = &$this->template->sitetitle;
	 $sitetitle = $sitetitle.Kohana::$config->load('mainmenu.'.$pageid.'.title').'::';
	 //Метатэги description и keywords
	 $description = &$this->template->description;
	 $description = $description.Kohana::$config->load('mainmenu.'.$pageid.'.description');
	 $keywords = &$this->template->keywords;
	 $keywords = $keywords.Kohana::$config->load('mainmenu.'.$pageid.'.keywords');
	 //Дополнительные css
	 $stylesheet = &$this->template->stylesheet;
	 $stylesheet = '<link rel="stylesheet" href="/public/css/'.Kohana::$config->load('mainmenu.'.$pageid.'.url').'.css" type="text/css" />';
	 //JavaScript Библиотеки
	 $javascriptlib = &$this->template->javascriptlib;
	 $javascriptlib = $javascriptlib.Kohana::$config->load('mainmenu.'.$pageid.'.javascript');
	 //JavaScript Настройки
	 if($javascriptcustom!='') {
	  $javascript = &$this->template->javascriptcustom;
	  $javascript = '
<script>
'.$javascript.$javascriptcustom.'
</script>';
	 }
	 //Главное меню
	 $this->template->menu  = $this->mainmenu($pageid);
	 //Разметка середины страницы
	 $middlename = Kohana::$config->load('mainmenu.'.$pageid.'.url');
	 $middle  = Request::factory('Chunks_Middle/'.$middlename)->execute();
	 $this->template->middle  = $middle;
	 
	} 
 
}

abstract class Blockmodules {
    
    protected $auth;
    protected $user;
    protected $session;
    protected $view;
    
    public function __construct() {
     
       Session::$default = 'database';
       $this->session = Session::instance();
       $this->auth = Auth::instance();
       $this->user = $this->auth->get_user();
       
       $this->view = View::factory('Public/Blockmodules/Blockmodule');
       
       //содержимое
       $this->view->title = 'Новый модуль!';
       $this->view->content = 'Содержимое модуля!';
       
       //стили
       $this->view->classmodulemaincont = 'rgt';
       $this->view->classmoduletitle = 'ht3';
       $this->view->classmodulecontentcont = 'cont';
       $this->view->idmodulecontentcont = 'cont';
     
    }
    
}
