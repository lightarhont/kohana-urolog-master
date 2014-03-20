<?php defined('SYSPATH') or die('No direct script access.');

class Calendarblockmodule extends Blockmodules {
 
 public function calendar() {
     
     $this->view->title = 'Календарь';
     
     $cr = new Calendar;
     
     $events = array('1' => 'прогулка с велосипедом', '7' => 'остальное');
     
     $this->view->content = $cr->fetchCalendar($events);
     
     return $this->view;
 }
 
}