<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Commenting extends Controller_Ajaxauth {
 
 protected $listlimit = 5;
 
 public function action_deletecomment() {
  if(isset($_POST) && !empty($_POST)) {
   $post = Arr::map('trim', $_POST);
   ORM::factory('Commentsorm', $post['id'])->delete();
   $this->template->body = 'Комментарий удалён!';
  }
  else {
   $this->template->body = 'Доступ запрещён!';
  }
 } 
 
 public function action_responseeditcomment() {
 
  if(isset($_POST) && !empty($_POST)) {
   $post = Arr::map('trim', $_POST);
   if(!empty($post['comment'])) {
   $post = Validation::factory($post);
   $post
   -> rule('title', 'max_length', array(':value', 90))
   -> rule('comment', 'max_length', array(':value', 6000));
   
   if($post->check()) {
   
    $parser  = Helper_BBparser::factory();
    $comment = $parser->process_bbcode($post['comment']);
	
    $commentsmodel = ORM::factory('Commentsorm', $post['id']);
	                 $commentsmodel
					 ->set('userid', $post['userid'])
					 ->set('thread', $post['comid'])
					 ->set('threadtitle', $post['conttitle'])
					 ->set('title', strip_tags($post['title']))
					 ->set('comment', $comment)
					 ->set('last_edited', time())
					 ->update();
					 
	$post = 'Комментарий успешно отредактирован!';
   }
   else {
    
	$posterror   = '<ul>';
	
	$errors = $post->errors('comments');
	
	if(isset($errors['title'])) {
     $posterror   .= '<li>'.$errors['title'].'</li>';
    }
	
	if(isset($errors['comment'])) {
     $posterror   .= '<li>'.$errors['comment'].'</li>';
    }
	
	$posterror   .= '</ul>';
	 
	$post = $posterror;
   
   }
   }
  else {
   $post = 'Комментарий не должен быть пустым!';
  }
  }
  else {
   $post = 'Доступ запрещён!';
  }
  
  $this->template->body = $post;
 }
 
 public function action_requesteditcomment() {
  
  if(isset($_POST) && !empty($_POST)) {
  $post = Arr::map('trim', $_POST);
  
  $commentsmodel = ORM::factory('Commentsorm');
  $result        = $commentsmodel
                   ->where('id', '=', $post['idcomment'] )
                   ->find()
				   ->as_array();

  
  $this->template->body = json_encode($result);
  }
  else {
  $this->template->body = 'Доступ запрещён!';
  }
 }
 
 public function action_formadcomments() {
  
 if ($this->auth->logged_in()) {
  $componentid = $this->request->param('componentid', '0');
  $form = View::factory('Public/Chunks/Adcomment');
  $form->componentid = $componentid;
  $form->userid = $this->user->id;
  }
  else {
  $form = '<div class="noauthuser">Только автризированные пользователи могут оставлять комментарии!</div>';
  }
  $this->template->body = $form;
 }
 
 public function action_formadcommentspost() {
  $post = Arr::map('trim', $_POST);
  if(!empty($post['comment'])) {
   $post = Validation::factory($post);
   $post
   -> rule('title', 'max_length', array(':value', 90))
   -> rule('comment', 'max_length', array(':value', 6000));
   
   if($post->check()) {
   
    $parser  = Helper_BBparser::factory();
    $comment = $parser->process_bbcode($post['comment']);
	
	$commentsmodel = ORM::factory('Commentsorm');
	                 $commentsmodel
					 ->set('userid', $post['userid'])
					 ->set('thread', $post['comid'])
					 ->set('threadtitle', $post['conttitle'])
					 ->set('title', strip_tags($post['title']))
					 ->set('comment', $comment)
					 ->set('created', time())
					 ->create();
	 
	 $post = 'Комментарий успешно добавлен!';
   }
   else {
    
	$posterror   = '<ul>';
	
	$errors = $post->errors('comments');
	
	if(isset($errors['title'])) {
     $posterror   .= '<li>'.$errors['title'].'</li>';
    }
	
	if(isset($errors['comment'])) {
     $posterror   .= '<li>'.$errors['comment'].'</li>';
    }
	
	$posterror   .= '</ul>';
	 
	$post = $posterror;
   
   }
   
  }
  else {
   $post = '<ul><li>Комментарий не должен быть пустым!</li></ul>';
  }
  
  $this->template->body = $post;
 }
 
 public function action_showcomments() {
   
  $componentid = $this->request->param('componentid', '0');
  $page        = $this->request->param('page', '1');
  $total       = $this->request->param('total', 'none');
  
  if($total == 'none') {
   
   $commentscount = ORM::factory('Commentsorm');
   $total = $commentscount
            ->where('thread', '=', $componentid)
            ->count_all();   
  }
  
  $offset = $this->listlimit*$page-$this->listlimit;
   
  $comments = Model::factory('Comments')->getcommentsandusers($componentid, $offset, $this->listlimit);
  $commenttpl = '<div id="allcomments">';
  $json = json_encode(array('componentid' => $componentid, 'total' => $total));
  $commenttpl .= '<div id="hiddencomponentid">'.$json.'</div>';
  $commenttpl .= '<div class="pagination">';
  $commenttpl .= Pagination::factory(array('total_items' => $total, 'view' => 'pagination/custom2', 'items_per_page' => $this->listlimit));
  $commenttpl .= '</div>';
  if ($this->auth->logged_in()) {
  $username = $this->user->username;
  }
  
  $findid = 1;
  if($page>1) {
   $findid = $offset+1;
  }
  foreach($comments as $comment) {
   
   if($this->auth->logged_in()) {
    if($comment->username == $username) {
     $options = '<div class="option1"><a href="javascript: void(0);" onclick="citeauthor('.$comment->commentid.');">Цитировать</a></div> <div class="option2"><a href="javascript: void(0);" onclick="editcomment('.$comment->commentid.');">Редактировать</a></div> <div class="option3"><a href="javascript: void(0);" onclick="deletecommentconfirm('.$comment->commentid.');">Удалить</a></div>';
    }
    else {
     $options = '<div class="option1"><a href="javascript: void(0);" onclick="citeauthor('.$comment->commentid.');">Цитировать</a></div>';
    }
   }
   else {
    $options = '';
   }
   
   $data = array(
                  'id'       => $findid,
		                  'commentid' => $comment->commentid,
				  'title'     => $comment->title,
				  'content'   => $comment->comment,
				  'username'  => $comment->username,
				  'datetime'  => $comment->created,
				  'options'   => $options
    ); 
   
   $commenttpl .= View::factory('Public/Chunks/Comment', $data);
   $findid +=1;
  }

  $commenttpl .= '</div>';
  
  //View::factory('profiler/stats')
  
  $this->template->body = $commenttpl;
 } 
 
}