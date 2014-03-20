<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Questions extends Model {
 
 protected $_tablequestions = 'questions';
 protected $_tablecatquestions = 'cat_questions';
 protected $_tableusers = 'users';
 
 public function Showquestions($offset, $limit, $catid=0, $userid) {
  
  if($catid==0) {

   $query = DB::select(array($this->_tableusers.'.id', 'userid'), array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecatquestions.'.id', 'catid'), array($this->_tablecatquestions.'.title', 'cattitle'), array($this->_tablequestions.'.id', 'questionid'), array($this->_tablequestions.'.userid', 'userid'), array($this->_tablequestions.'.private', 'private'), array($this->_tablequestions.'.url', 'url'), array($this->_tablequestions.'.title', 'title'), array($this->_tablequestions.'.annonce', 'annonce'), array($this->_tablequestions.'.created', 'created'))
   ->from($this->_tablequestions)
   ->join($this->_tablecatquestions)
   ->on($this->_tablequestions.'.catid', '=', $this->_tablecatquestions.'.id')
   ->join($this->_tableusers)
   ->on($this->_tablequestions.'.userid', '=', $this->_tableusers.'.id')
   ->where_open()
   ->where($this->_tablequestions.'.private', '=', '0')
   ->or_where($this->_tablequestions.'.userid', '=', $userid)
   ->where_close()
   ->offset($offset)
   ->limit($limit);
 
  }
  else {
  
   $query = DB::select(array($this->_tableusers.'.id', 'userid'), array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecatquestions.'.id', 'catid'), array($this->_tablecatquestions.'.title', 'cattitle'), array($this->_tablequestions.'.id', 'questionid'), array($this->_tablequestions.'.userid', 'userid'), array($this->_tablequestions.'.private', 'private'), array($this->_tablequestions.'.url', 'url'), array($this->_tablequestions.'.title', 'title'), array($this->_tablequestions.'.annonce', 'annonce'), array($this->_tablequestions.'.created', 'created'))
   ->from($this->_tablequestions)
   ->join($this->_tablecatquestions)
   ->on($this->_tablequestions.'.catid', '=', $this->_tablecatquestions.'.id')
   ->join($this->_tableusers)
   ->on($this->_tablequestions.'.userid', '=', $this->_tableusers.'.id')
   ->where_open()
   ->where($this->_tablequestions.'.private', '=', '0')
   ->or_where($this->_tablequestions.'.userid', '=', $userid)
   ->where_close()
   ->where($this->_tablequestions.'.catid', '=', $catid)
   ->offset($offset)
   ->limit($limit);
   
  }
  
  return $query->as_object()->execute();
  
 }
 
 public function Showquestionsnouser($offset, $limit, $catid=0) {
  
  if($catid==0) {

   $query = DB::select(array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecatquestions.'.id', 'catid'), array($this->_tablecatquestions.'.title', 'cattitle'), array($this->_tablequestions.'.id', 'questionid'), array($this->_tablequestions.'.userid', 'userid'), array($this->_tablequestions.'.private', 'private'), array($this->_tablequestions.'.url', 'url'), array($this->_tablequestions.'.title', 'title'), array($this->_tablequestions.'.annonce', 'annonce'), array($this->_tablequestions.'.created', 'created'))
   ->from($this->_tablequestions)
   ->join($this->_tablecatquestions)
   ->on($this->_tablequestions.'.catid', '=', $this->_tablecatquestions.'.id')
   ->join($this->_tableusers)
   ->on($this->_tablequestions.'.userid', '=', $this->_tableusers.'.id')
   ->where($this->_tablequestions.'.private', '=', '0')
   ->offset($offset)
   ->limit($limit);
 
  }
  else {
  
   $query = DB::select(array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecatquestions.'.id', 'catid'), array($this->_tablecatquestions.'.title', 'cattitle'), array($this->_tablequestions.'.id', 'questionid'), array($this->_tablequestions.'.userid', 'userid'), array($this->_tablequestions.'.private', 'private'), array($this->_tablequestions.'.url', 'url'), array($this->_tablequestions.'.title', 'title'), array($this->_tablequestions.'.annonce', 'annonce'), array($this->_tablequestions.'.created', 'created'))
   ->from($this->_tablequestions)
   ->join($this->_tablecatquestions)
   ->on($this->_tablequestions.'.catid', '=', $this->_tablecatquestions.'.id')
   ->join($this->_tableusers)
   ->on($this->_tablequestions.'.userid', '=', $this->_tableusers.'.id')
   ->where($this->_tablequestions.'.catid', '=', $catid)
   ->where($this->_tablequestions.'.private', '=', '0')
   ->offset($offset)
   ->limit($limit);
   
  }
  
  return $query->as_object()->execute();
  
 }
 
 public function Showquestion($url) {
  
   $query = DB::select(array($this->_tableusers.'.fullname', 'fullname'), array($this->_tableusers.'.username', 'username'), array($this->_tablecatquestions.'.id', 'catid'), array($this->_tablecatquestions.'.title', 'cattitle'), array($this->_tablequestions.'.id', 'questionid'), array($this->_tablequestions.'.userid', 'userid'), array($this->_tablequestions.'.private', 'private'), array($this->_tablequestions.'.url', 'url'), array($this->_tablequestions.'.title', 'title'), array($this->_tablequestions.'.annonce', 'annonce'), array($this->_tablequestions.'.content', 'content'), array($this->_tablequestions.'.created', 'created'))
   ->from($this->_tablequestions)
   ->join($this->_tablecatquestions)
   ->on($this->_tablequestions.'.catid', '=', $this->_tablecatquestions.'.id')
   ->join($this->_tableusers)
   ->on($this->_tablequestions.'.userid', '=', $this->_tableusers.'.id')
   ->where($this->_tablequestions.'.url', '=', $url); 
  
  $result = $query->as_object()->execute();
  
  if($result) {
            return $result[0];
        }
        else {
            return FALSE;
        }
 
 }
 
}