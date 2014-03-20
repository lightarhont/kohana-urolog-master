<?php defined('SYSPATH') or die('No direct script access.');

class ccblockmodule extends Blockmodules {
 
 public function show() {
  
  $this->view->content = '<div class="abouttext">В каталоге собраны различные урологические препараты для терапевтического лечения и протезы. Которые могут продаваться при оказании услуг.</div>';
  $this->view->title = 'Раздел каталог';
  
  return $this->view;  
 }
 
}