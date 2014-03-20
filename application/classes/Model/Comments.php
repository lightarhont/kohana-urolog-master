<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Comments extends Model {
 
 protected $_tablecomments = 'comments';
 protected $_tableusers    = 'users';
 
 public function getcommentsandusers($componentid, $offset, $limit) {
 
  $query = DB::select(array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecomments.'.id', 'commentid'), array($this->_tablecomments.'.title', 'title'), array($this->_tablecomments.'.comment', 'comment'), array($this->_tablecomments.'.created', 'created'))
  ->from($this->_tablecomments)
  ->join($this->_tableusers)
  ->on($this->_tablecomments.'.userid', '=', $this->_tableusers.'.id')
  ->where($this->_tablecomments.'.thread', '=', $componentid)
  ->offset($offset)
  ->limit($limit);
  
  return $query->as_object()->execute();
 }
 
  public function getlastcommentsandusers($limit=3) {
 
  $query = DB::select(array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecomments.'.id', 'commentid'), array($this->_tablecomments.'.threadtitle', 'contenttitle'), array($this->_tablecomments.'.thread', 'contenttypeandid'), array($this->_tablecomments.'.title', 'title'), array($this->_tablecomments.'.comment', 'comment'), array($this->_tablecomments.'.created', 'created'))
  ->from($this->_tablecomments)
  ->join($this->_tableusers)
  ->on($this->_tablecomments.'.userid', '=', $this->_tableusers.'.id')
  ->order_by('created', 'DESC')
  ->limit($limit);
  
  return $query->execute();
 }
 
}