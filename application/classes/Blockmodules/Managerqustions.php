<?php defined('SYSPATH') or die('No direct script access.');

class mqsblockmodule extends Blockmodules {
 
 public function show() {
  
  if($this->auth->logged_in()) {
   $this->view->content = '<div class="adquestion">'.Form::formsubmitfunc('Задать вопрос', '', 'newquestion').'</div>';
  }
  else {
   $this->view->content = '';
  }
  $this->view->content .= '<div class="abouttitle">О разделе:</div><div class="abouttext">Данный раздел позволяет задавать вопросы врачу урологу. Задать вопрос можно открыто и анонимно. Отвечать в вопросе, имеют возможность лишь врач и тот кто задал вопрос.<br />Временно недоступно - создавать анонимные вопросы.</div>';
  
  $this->view->title = 'Задать вопрос';
  
  return $this->view;
 }

}