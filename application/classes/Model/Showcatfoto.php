<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Showcatfoto extends Model {
 
 protected $_tablecatfotos = 'cat_fotos';
 protected $_tablefotos    = 'fotos';
 
 public function get_deffotos($limit=10) {
 
 $sql = "SELECT `".$this->_tablefotos."`.*, `".$this->_tablecatfotos."`.`description` AS `catdesc`, `".$this->_tablecatfotos."`.`name` AS `catname` FROM `".$this->_tablefotos."` JOIN `".$this->_tablecatfotos."` ON (`".$this->_tablefotos."`.`catid` = `".$this->_tablecatfotos."`.`id`) WHERE `".$this->_tablecatfotos."`.`catdefault` = :catdefault LIMIT ".$limit;
 $query = DB::query(Database::SELECT, $sql);
 $query->param(':catdefault', '1');
		
 return $query->as_object()->execute();
 }
 
  public function get_deffotos_count() {
 
 $sql = "SELECT COUNT(*) AS `total_fotos` FROM `".$this->_tablefotos."` JOIN `".$this->_tablecatfotos."` ON (`".$this->_tablefotos."`.`catid` = `".$this->_tablecatfotos."`.`id`) WHERE `".$this->_tablecatfotos."`.`catdefault` = :catdefault GROUP BY `".$this->_tablefotos."`.id";
 $query = DB::query(Database::SELECT, $sql);
 $query->param(':catdefault', '1');
		
 return $query->as_object()->execute();
 }
 
 public function get_fotos_count($catid) {
 
 $sql = "SELECT COUNT(*) AS `total_fotos` FROM `".$this->_tablefotos."` WHERE `catid` = :catid GROUP BY id";
 $query = DB::query(Database::SELECT, $sql);
 $query->param(':catid', $catid);
 
 return $query->as_object()->execute();
 }
 
 public function get_catidfotos($catid, $limit=10) {
 
 $sql = "SELECT `".$this->_tablefotos."`.*, `".$this->_tablecatfotos."`.`description` AS `catdesc`, `".$this->_tablecatfotos."`.`name` AS `catname` FROM `".$this->_tablefotos."` JOIN `".$this->_tablecatfotos."` ON (`".$this->_tablefotos."`.`catid` = `".$this->_tablecatfotos."`.`id`) WHERE `".$this->_tablefotos."`.`catid` = :catid LIMIT ".$limit;
 $query = DB::query(Database::SELECT, $sql);
 $query->param(':catid', $catid);
		
 return $query->as_object()->execute();
 }
 
 public function get_pages_fotos($catid, $offset=0, $limit=10) {
 $sql = "SELECT * FROM `".$this->_tablefotos."` WHERE `catid` = :catid LIMIT ".$limit." OFFSET ".$offset;
 $query = DB::query(Database::SELECT, $sql);
 $query->param(':catid', $catid);
 
 return $query->as_object()->execute();
 }
  
}