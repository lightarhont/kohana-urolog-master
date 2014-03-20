<?php defined('SYSPATH') or die('No direct script access.');

class cqsblockmodule extends Blockmodules {
 
 public function show() {
  $model = ORM::factory('Catsquestionsorm');
  $results = $model->find_all();
  $content = '<div class="allquestions"><a href="/questions.html">Все вопросы</a></div>';
  $content .= '<ul class="listcatqustions">';
  foreach($results as $result) {
   $content .= '<li><a href="questions/catid-'.$result->id.'.html">'.$result->title.'</a><br />'.$result->description.'</li>';
  }
  $content .= '</ul>';
  $this->view->content = $content;
  $this->view->title = 'Категории вопросов';
  
  return $this->view;
 }
 
}