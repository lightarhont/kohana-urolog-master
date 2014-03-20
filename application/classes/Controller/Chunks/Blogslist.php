<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Blogslist extends Controller {
    
    public $listlimit = 3;
    
    public function action_showblogs() {
     
     $model = ORM::factory('Blogslistorm');
     
     $countblogslist = $model->count_all();
     
     $page   = $this->request->param('page', '1');
     
     $offset = $this->listlimit*$page-$this->listlimit;
     
     $blogslist = $model->offset($offset)->limit($this->listlimit)->order_by('id', 'DESC')->find_all();
     
     $response = '';
     $id = 0;
     
     while($id<count($blogslist)) {
     
     $model2 = ORM::factory('Blogslistorm', $blogslist[$id]->id);
     
     $tags = $model2->tags->find_all();
     
     $thistags = '';
     
     foreach ($tags as $tag) {
        
        $thistags .=  '<a href="blog/tag-'.$tag->id.'/page-1.html">'.$tag->name.'</a>, ';
        
        } 
     
      $thistags = rtrim($thistags, ', ');
      
      $componentid = 'singleblog='.$blogslist[$id]->url;
      $totalcomments = Request::factory('countcomments/'.$componentid)->execute();
      
      $data = array('tags' => $thistags,
                    'url' => $blogslist[$id]->url,
                    'blogtitle' => $blogslist[$id]->title,
                    'totalcomments' => $totalcomments,
                    'blogdate' => $blogslist[$id]->created,
                    'blogannonce' => $blogslist[$id]->annonce);
      $response .= View::factory('Public/Chunks/Bloglist', $data);
      
      $id = $id + 1;
     }
     
     $response .= '<div class="pagination">';
     $response .= Pagination::factory(array('total_items' => $countblogslist, 'view' => 'pagination/custom3', 'items_per_page' => $this->listlimit));
     $response .= '</div>';
     
     $this->response->body($response);
    }
    
    public function action_showblogstag() {
     
     $tag   = $this->request->param('tag', '1');
     $page   = $this->request->param('page', '1');
     
     $model = ORM::factory('Tagsorm', $tag);
     
     $countblogslist = $model->blogslist->count_all();
     
     $offset = $this->listlimit*$page-$this->listlimit;
     
     $blogs = $model->blogslist->offset($offset)->limit($this->listlimit)->order_by('id', 'DESC')->find_all();
     
     $taghtml = '<a href="blog/tag-'.$tag.'/page-1.html">'.$model->name.'</a>';
     
     $response = '';
     foreach($blogs as $blog) {
      
      $componentid = 'singleblog='.$blog->url;
      $totalcomments = Request::factory('countcomments/'.$componentid)->execute();
      
      $data = array('tags' => $taghtml,
                    'url' => $blog->url,
                    'blogtitle' => $blog->title,
                    'totalcomments' => $totalcomments,
                    'blogdate' => $blog->created,
                    'blogannonce' => $blog->annonce);
      $response .= View::factory('Public/Chunks/Bloglist', $data);
        
     }
     
     $response .= '<div class="pagination">';
     $response .= Pagination::factory(array('total_items' => $countblogslist, 'view' => 'pagination/custom4', 'items_per_page' => $this->listlimit), null, $tag);
     $response .= '</div>';
     
     $this->response->body($response);  
    }
}