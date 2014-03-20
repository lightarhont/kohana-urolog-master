<?php defined('SYSPATH') or die('No direct script access.');

require_once(APPPATH.'classes/Controller/Manager/Mixins/Tablelist'.EXT);

class Controller_Manager_Blogs extends Controller_Manager_Common {
    
 use tablelist;
 
 public function beforeclient()
 {
  
  $this->mainmenuact = 1;
  $this->configfile .= 'blogs';
  
  $this->template->sitetitle .= 'Менеджер блога';
  View::set_global('header', 'МЕНЕДЖЕР БЛОГА:');
  View::set_global('uripath', 'manager/blogs/');
  
 }
 
 public function action_blogslist()
 {
  $this->template->sitetitle .= '::Список постов';
  $this->bildtablejs();
  if(!empty($_POST)):
   $this->posttablelist(Arr::map('trim', $_POST));
  endif;
  $page   = (int)$this->request->param('page', '1');
  $offset = $this->listlimit*$page-$this->listlimit;
  $model = ORM::factory($this->orm);
  $countblogslist = $model->count_all();
  $results = $model->offset($offset)->limit($this->listlimit)->find_all();
  $blogs = '';
  foreach($results as $result) :
   $model = ORM::factory($this->orm, $result->id);
   $tags  = $model->tags->find_all();
   $blogtags = '';
   foreach($tags as $tag) :
    $blogtags .= '<a href="#">'.$tag->name.'</a> ';
   endforeach;
   
   $data = array(
    'id'       => $result->id,
    'title'    => $result->title,
    'url'      => $result->url,
    'tags'     => $blogtags,
    'comments' => $result->comments,
    'order'    => $result->order
                );
   $blogs .= View::factory($this->cvpath.'Tr', $data);  
  endforeach;
  $pagination = Pagination::factory(array('total_items' => $countblogslist, 'items_per_page' => $this->listlimit, ));
  $middle = $this->tableview('СПИСОК ПОСТОВ', $blogs, $pagination);
  $this->template->middle = $middle;
 }
 
 public function action_tagslist()
 {
  $this->template->sitetitle .= '::Список тэгов';
  $this->bildtablejs();
  if(!empty($_POST)):
   $this->posttablelist(Arr::map('trim', $_POST));
  endif;
  $page   = (int)$this->request->param('page', '1');
  $listlimit = 10;
  $offset = $this->listlimit*$page-$listlimit;
  $model = ORM::factory($this->orm);
  $counttagslist = $model->count_all();
  if($counttagslist <= $listlimit) :
   $results = $model->find_all();
  else :
   $results = $model->offset($offset)->limit($listlimit)->find_all();
  endif;
  $tags = '';
  foreach($results as $result) :
   $model = ORM::factory($this->orm, $result->id);
   $blogs = $model->count_relations('blogslist');
   if($blogs != 0) :
    $blogs .= ' раз';
   else :
    $blogs = 'Не используется';
   endif;
   $data = array('id' => $result->id,
                 'title' => $result->name,
                 'countblogs' => $blogs,
                 'order' => $result->order);
   $tags .= View::factory($this->cvpath.'Tr', $data);  
  endforeach;
  $pagination = Pagination::factory(array('total_items' => $counttagslist, 'items_per_page' => $listlimit, ));
  $middle = $this->tableview('СПИСОК ПОСТОВ', $tags, $pagination);
  $this->template->middle = $middle;
 }
 
 public function action_addtag()
 {
  $this->template->sitetitle .= '::Новый тэг';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/Submit');
  $middle = View::factory($this->cvpath.'Index');
  $this->template->middle = $middle;
 }
 
 public function action_addblog()
 {
  $this->template->sitetitle .= '::Новый пост';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/Submit');
  $middle = View::factory($this->cvpath.'Index');
  $model = ORM::factory('Tagsorm');
  $tags  = $model->find_all();
  $taglist = '';
  foreach($tags as $tag) :
   $taglist .= '<div><input type="checkbox" name="tag-'.$tag->id.'" /><span>'.$tag->name.'</span></div>';
  endforeach;
  $middle->tags = $taglist;
  $this->template->middle = $middle;
 }
 
 public function action_edittag()
 {
  $this->template->sitetitle .= '::Редактировать тэг';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/Submit');
  $itemid   = (int)$this->request->param('itemid', '1');
  $result = ORM::factory($this->orm, $itemid);
  $middle = View::factory($this->cvpath.'Index');
  $middle->title = $result->name;
  $middle->id = $result->id;
  $this->template->middle = $middle;
 }
 
 public function action_editblog()
 {
  $this->template->sitetitle .= '::Редактировать пост';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/Submit');
  $middle = View::factory($this->cvpath.'Index');
  $itemid   = (int)$this->request->param('itemid', '1');
  $modela = ORM::factory($this->orm, $itemid);
  $selected = $modela->tags->find_all()->as_array();
  $modelb = ORM::factory('Tagsorm');
  $tags  = $modelb->find_all();
  $taglist = '';
  foreach($tags as $tag) :
   if(in_array($tag->id, $selected)) :
    $taglist .= '<div><input type="checkbox" checked="checked" name="tag-'.$tag->id.'" /><span>'.$tag->name.'</span></div>';
   else :
    $taglist .= '<div><input type="checkbox" name="tag-'.$tag->id.'" /><span>'.$tag->name.'</span></div>';
   endif;
  endforeach;
  $data = array('id'   => $modela->id,
                'title' => $modela->title,
                'url'   => $modela->url,
                'annonce' => $modela->annonce,
                'content' => $modela->content,
                'comments' => $modela->comments,
                'tags' => $taglist
                );
  $middle = View::factory($this->cvpath.'Index', $data);
  $this->template->middle = $middle;
 }
 
 protected function insertrecordtag()
 {
  
  $post  = Arr::map('trim', $_POST);
  $model = ORM::factory($this->orm);
  $model->set('name', $post['title'])->create();
 
 }
 
 protected function insertrecordpost()
 {
  $post  = Arr::map('trim', $_POST);
  $time  = time();
  $model = ORM::factory($this->orm);
  $data = array('title'    => $post['title'],
                'url'      => $post['url'],
                'annonce'  => $post['annonce'],
                'content'  => $post['content'],
                'comments' => (isset($post['comments'])) ? 1 : 0,
                'created'  => $time);
  
  $arrayitems = function() use ($post) {
   
   $result = array();
   foreach($post as $key=>$value):
    if(preg_match('(^tag-[0-9])', $key)) :
     $result[] = str_replace('tag-', '', $key);
    endif;
   endforeach;
   return $result;
   
  };
  
  $model->values($data)->create();
  $arraytags = $arrayitems();
  if(!empty($arraytags)) :
   $model->add('tags', $arraytags);
  endif;
 }
 
 protected function updaterecordtag()
 {
  $post  = Arr::map('trim', $_POST);
  $model = ORM::factory($this->orm, $post['id']);
  $model->set('name', $post['title'])->update();
 } 
 
 protected function updaterecordpost()
 {
  $post  = Arr::map('trim', $_POST);
  $model = ORM::factory($this->orm, $post['id']);
  $data = array('title'    => $post['title'],
                'url'      => $post['url'],
                'annonce'  => $post['annonce'],
                'content'  => $post['content'],
                'comments' => (isset($post['comments'])) ? 1 : 0
                );
  
  $arrayitems = function() use ($post) {
   
   $result = array();
   foreach($post as $key=>$value):
    if(preg_match('(^tag-[0-9])', $key)) :
     $result[] = str_replace('tag-', '', $key);
    endif;
   endforeach;
   return $result;
   
  };
  
  $model->values($data)->update();
  $arraytags = $arrayitems();
  if(!empty($arraytags)) :
   $model->remove('tags');
   $model->add('tags', $arraytags);
  else :
   $model->remove('tags');
  endif;
 }
 
 public function afterclient()
 {
    
  $this->bildmenu();
  
 }
}