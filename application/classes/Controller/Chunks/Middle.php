<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Middle extends Controller {
 
 public function action_index() {
 
  $middle = View::factory('Public/Chunks/IndexPage');
  $middle->latestcomments = Request::factory('Chunks_Latestcomments/lastcomment')->execute();;
  $this->response->body($middle);
  
 }
 
  public function action_about() {
 
  $middle = View::factory('Public/Chunks/AboutPage');
  $this->response->body($middle);
  
 }
 
  public function action_blog() {
 
  $page   = $this->request->param('id', '1');
  $middle = 3;
  //Request::factory('bloglist/page-'.$page.'.html')->execute();
  $this->response->body($middle);
  
 }
 
  public function action_foto() {
 
  $middle = View::factory('Public/Chunks/FotoPage');
  $middle->categories = Request::factory('Chunks_Foto/categories')->execute();
  $middle->category   = Request::factory('Chunks_Foto/defcategory')->execute();
  $this->response->body($middle);
  
 }
 
  public function action_video() {
 
  $middle = View::factory('Public/Chunks/VideoPage');
  $this->response->body($middle);
  
 }
 
  public function action_files() {
 
  $middle = View::factory('Public/Chunks/ServicePage');
  $this->response->body($middle);
  
 }
 
  public function action_question() {
 
  $middle = View::factory('Public/Chunks/QuestionPage');
  $this->response->body($middle);
  
 }
 
  public function action_category() {
 
  $middle = View::factory('Public/Chunks/CategoryPage');
  $this->response->body($middle);
  
 }

}