<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Formajaxvalidation extends Controller {
    
    public function before()
    {
        if(! $this->request->is_ajax()) :
         throw HTTP_Exception::factory(501, 'AJAX request not detected');
        endif;
    }
    
    public function action_index()
    {
        
        if($this->request->method() == Request::POST) :
         $post = Arr::map('trim', $_POST);
         $process   = $this->request->param('process', NULL);
         if($process != NULL) :
          $file = APPPATH.'classes/Controller/Manager/Rules/'.$process.EXT;
          if(file_exists($file)) :
           require_once($file);
           $this->response
           ->headers('Content-Type', 'text/plain; charset=utf-8')
           ->headers('Cache-Control', 'no-store')
           ->body($result());
          endif;
         endif;
        endif;
        
    }
    
}

