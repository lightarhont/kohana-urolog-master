<?php defined('SYSPATH') or die('No direct script access.');

//Routes helper
$ext = EXT;
$rh = function($file) use (&$rmr, &$directory, $ext) 
{
 
 $defaults = function($action) use (&$defaultsparam, $directory) {
  if(!empty($directory)) :
   $defaultsparam['directory'] = $directory;
  endif;
  $defaultsparam['action'] = $action;
  return $defaultsparam;
 };
 
 //if (!Route::cache()) :
  require_once($rmr.$file.$ext);
  //Route::cache(TRUE);
 //endif;
};

define('ROUTES', APPPATH.'routes/');

//Manager routes
$rmr = ROUTES.'manager/'; //Import path
$directory = 'Manager';
Route::$default_name_prefix = 'mr';

//fotos
$rh('fotos');
//blogs
$rh('blogs');
//users
$rh('users');
//comments
$rh('comments');

//Frontend routes
Route::$default_name_prefix = '';

Route::set('fav', 'manager/fav(/<process>)', array('process' => '[a-zA-Z0-9-]+') )
        ->defaults(array(
            'directory'  => 'Manager',
            'controller' => 'Formajaxvalidation',
            'action' => 'index',
    ));

Route::set('mrlogout', 'manager/logout.html')
        ->defaults(array(
            'directory'  => 'Manager',
            'controller' => 'Index',
            'action' => 'logout',
    ));

Route::set('mrindex', 'manager')
        ->defaults(array(
            'directory'  => 'Manager',
            'controller' => 'Index',
            'action' => 'index',
    ));

Route::set('pagescategory', 'category.html')
        ->defaults(array(
            'controller' => 'Category',
            'action' => 'category',
    ));    
    
Route::set('pagesquestions', 'questions(/catid-<catid>)(/page-<page>).html', array('page' => '[0-9]+'), array('catid' => '[0-9]+'))
        ->defaults(array(
            'controller' => 'Questions',
            'action' => 'questions',
    ));
    
Route::set('pagesfiles', 'files.html')
        ->defaults(array(
            'controller' => 'Files',
            'action' => 'files',
    ));
    
Route::set('pagesvideo', 'video.html')
        ->defaults(array(
            'controller' => 'Video',
            'action' => 'video',
    ));
    
Route::set('pagesfoto', 'foto.html')
        ->defaults(array(
            'controller' => 'Fotos',
            'action' => 'fotos',
    ));
    
Route::set('pagesabout', 'about.html')
        ->defaults(array(
            'controller' => 'About',
            'action' => 'about',
    ));

Route::set('pagesindex', 'index.html')
        ->defaults(array(
            'controller' => 'Index',
            'action' => 'index',
    ));
    
Route::set('pagesblog', 'blog(/tag-<tag>)(/page-<page>).html', array('page' => '[0-9]+'), array('tag' => '[0-9]+'))
        ->defaults(array(
            'controller' => 'Blog',
            'action' => 'blog',
    ));
        
Route::set('blogview', 'blogview(/<blogurl>).html', array('blogurl' => '[a-zA-Z0-9-]+'))
        ->defaults(array(
            'controller' => 'Singleblog',
            'action' => 'singleblog',
    ));

Route::set('catalogview', 'catalogview(/<catalogurl>).html', array('catalogurl' => '[a-zA-Z0-9-]+'))
        ->defaults(array(
            'controller' => 'Catalogitem',
            'action' => 'catalogitem',
    ));

Route::set('questionview', 'questionview(/<questionurl>).html', array('questionurl' => '[a-zA-Z0-9-]+'))
        ->defaults(array(
            'controller' => 'Singlequestion',
            'action' => 'singlequestion',
    ));

Route::set('questionnew', 'questionnew.html')
        ->defaults(array(
            'controller' => 'Newquestion',
            'action' => 'newquestion',
    ));

Route::set('questionnewpost', 'questionnewpost.html')
        ->defaults(array(
            'controller' => 'Newquestion',
            'action' => 'newquestionpost',
    ));

Route::set('questionedit', 'questionedit(/<questionurl>).html', array('questionurl' => '[a-zA-Z0-9-]+'))
        ->defaults(array(
            'controller' => 'Newquestion',
            'action' => 'editquestion',
    ));

Route::set('questiondelete', 'questiondelete(/<questionurl>).html', array('questionurl' => '[a-zA-Z0-9-]+'))
        ->defaults(array(
            'controller' => 'Newquestion',
            'action' => 'deletequestion',
    ));

Route::set('questiondeletepost', 'questiondeletepost.html')
        ->defaults(array(
            'controller' => 'Newquestion',
            'action' => 'deletequestionpost',
    ));
    
Route::set('commenting', 'comments(/<componentid>(/<page>(/<total>)))', array('componentid' => '[a-zA-Z0-9=-]+'), array('page' => '[0-9]+'), array('total' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Commenting',
            'action'     => 'showcomments',
        ));

Route::set('countcomments', 'countcomments(/<componentid>)', array('componentid' => '[a-zA-Z0-9=-]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Countscomments',
            'action'     => 'index',
        ));
		
Route::set('formadcomments', 'formadcomments(/<componentid>)', array('componentid' => '[a-zA-Z0-9=-]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Commenting',
            'action'     => 'formadcomments',
        ));

Route::set('formadcommentspost', 'commentpost.html')
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Commenting',
            'action'     => 'formadcommentspost',
        ));

Route::set('requesteditcomment', 'requesteditcomment.html')
        ->defaults(array(
		    'directory'  => 'Chunks',
            'controller' => 'Commenting',
            'action'     => 'requesteditcomment',
        ));

Route::set('deletecomment', 'deletecomment.html')
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Commenting',
            'action'     => 'deletecomment',
        ));

Route::set('responseeditcomment', 'responseeditcomment.html')
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Commenting',
            'action'     => 'responseeditcomment',
        ));

Route::set('bloglist', 'bloglist(/page-<page>).html', array('page' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Blogslist',
            'action'     => 'showblogs',
        ));

Route::set('taglist', 'taglist.html')
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Tagslist',
            'action'     => 'showtags',
        ));

Route::set('blogname', 'singleblog(/<blogurl>).html', array('blogurl' => '[a-zA-Z0-9-]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Blogid',
            'action'     => 'article',
        ));

Route::set('bloglisttag', 'bloglisttag(/tag-<tag>)(/page-<page>).html', array('page' => '[0-9]+'), array('tag' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Blogslist',
            'action'     => 'showblogstag',
        ));     

Route::set('showfoto', 'showfoto(/id-<id>).html', array('id' => '[0-9]+'))
            ->defaults(array(
            'controller' => 'Fotoid',
            'action'     => 'showfoto',
            ));

Route::set('showvideo', 'showvideo(/id-<id>).html', array('id' => '[0-9]+'))
            ->defaults(array(
            'controller' => 'Videoid',
            'action'     => 'showfoto',
            ));
	
Route::set('logout', 'logout.html')
            ->defaults(array(
            'directory'  => 'Chunks',
            'controller' => 'Login',
            'action'     => 'logout',
            ));

Route::set('registr', '<action>.html', array('action' => 'registration|registrationpost'))
            ->defaults(array(
            'controller' => 'Registr',
            ));

Route::set('remember', '<action>.html', array('action' => 'rememberpassword|rememberpasswordpost'))
            ->defaults(array(
            'controller' => 'Remember',
            ));

Route::set('activation', 'activation(/<username>).html', array('username' => '[a-zA-Z0-9=+-]+'))
            ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Activation',
            'action'     => 'activation',
            ));

Route::set('activationpass', 'activationpassword(/<url_key>).html', array('url_key' => '[a-zA-Z0-9]+'))
            ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Activationpass',
            'action'     => 'activation',
            ));

Route::set('csf_pagination', 'fotocategories(/<page>)', array('page' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Foto',
            'action'     => 'categories',
        ));

Route::set('csv_pagination', 'videocategories(/<page>)', array('page' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Video',
            'action'     => 'categories',
        ));

Route::set('cyf_catid', 'fotocategoryid(/<catid>)', array('catid' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Foto',
            'action'     => 'idcategory',
        ));

Route::set('cyv_catid', 'videocategoryid(/<catid>)', array('catid' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Video',
            'action'     => 'idcategory',
        ));

Route::set('cyfp_catid', 'fotocategorypages(/<catid>(/<page>(/<total>)))', array('catid' => '[0-9]+'), array('page' => '[0-9]+'), array('total' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Foto',
            'action'     => 'pagescategory',
        ));

Route::set('cyvp_catid', 'videocategorypages(/<catid>(/<page>(/<total>)))', array('catid' => '[0-9]+'), array('page' => '[0-9]+'), array('total' => '[0-9]+'))
        ->defaults(array(
	    'directory'  => 'Chunks',
            'controller' => 'Video',
            'action'     => 'pagescategory',
        ));
 
Route::set('default', '(<controller>(/<action>(/<id>)))')
        ->defaults(array(
            'controller' => 'Index',
            'action'     => 'index',
        ));

//exit(var_dump(Route::all()));
