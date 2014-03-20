<?php defined('SYSPATH') or die('No direct script access.');

require_once(APPPATH.'classes/Controller/Manager/Mixins/Tablelist'.EXT);

class Controller_Manager_Fotos extends Controller_Manager_Common {
    
 use tablelist;
 
 public function beforeclient()
 {
  
  $this->mainmenuact = 2;
  $this->configfile .= 'fotos';
  
  $this->template->sitetitle .= 'Менеджер фото';
  View::set_global('header', 'МЕНЕДЖЕР ФОТО:');
  View::set_global('uripath', 'manager/fotos/');
  
 }
 
 public function action_fotoslist()
 {
  $this->template->sitetitle .= '::Список Фото';
  $this->bildtablejs();
  if(!empty($_POST)):
   $this->posttablelist(Arr::map('trim', $_POST));
  endif;
  $model = ORM::factory('Catsfoto');
  $results = $model->find_all();
  $categories = '<option value="0"></option>';
  $catid   = (int)$this->request->param('catid', 0);
  
  foreach($results as $result) :
   if($catid == $result->id) :
    $this->template->sitetitle .= $result->name;
    $categories .= '<option selected="selected" value="'.$result->id.'">'.$result->name.'</option>';
   else :
    $categories .= '<option value="'.$result->id.'">'.$result->name.'</option>';
   endif;
  endforeach;
  
  $model = ORM::factory('Fotoandcategories');
  $page   = (int)$this->request->param('page', '1');
  $offset = $this->listlimit*$page-$this->listlimit;
  if($catid == 0):
   $countfotoslist = $model->count_all();
   $results = $model->offset($offset)->limit($this->listlimit)->find_all();
  else:
   $countfotoslist = $model->where('catid', '=', $catid)->count_all();
   $results = $model->where('catid', '=', $catid)->offset($offset)->limit($this->listlimit)->find_all();
  endif;
  $fotos = '';
  foreach($results as $result) :
   $data = array(
    'id'      => $result->id,
    'title'   => $result->name,
    'icon'    => $result->img,
    'order'   => $result->order,
    'catname' => $result->catsfoto->name,
                 );
   $fotos .= View::factory($this->cvpath.'Tr', $data);
  endforeach;
  $pagination = Pagination::factory(array('total_items' => $countfotoslist, 'items_per_page' => $this->listlimit, ));
  $middle = $this->tableview('СПИСОК ФОТО', $fotos, $pagination);
  $this->template->middle = $middle;
 
 }
 
 public function action_categorieslist()
 {
  
  $this->template->sitetitle .= '::Список категорий';
  $this->bildtablejs();
  if(!empty($_POST)):
   $this->posttablelist(Arr::map('trim', $_POST));
  endif;
  $model = ORM::factory('Catsfoto');
  $countcategorieslist = $model->count_all();
  $page   = (int)$this->request->param('page', '1');
  $offset = $this->listlimit*$page-$this->listlimit;
  $results = $model->offset($offset)->limit($this->listlimit)->find_all();
  
  $categories = '';
  foreach ($results as $result) :
   $data = array(
            'id'          => $result->id,
            'title'        => $result->name,
            'description' => $result->description,
            'icon'        => $result->img,
            'default'     => $result->catdefault,
            'order'       => $result->order
            );
   
   $categories .=  View::factory($this->cvpath.'Tr', $data);
  endforeach;
  $pagination = Pagination::factory(array('total_items' => $countcategorieslist, 'items_per_page' => $this->listlimit, ));
  $middle = $this->tableview('СПИСОК КАТЕГОРИЙ', $categories, $pagination);
  $this->template->middle = $middle;
 
 }
 
 protected function deletefotofiles()
 {
  
  $id = $this->itemparam;
  $item = ORM::factory($this->orm, $id);
  @unlink($this->options['addfoto']['fimg'].$item->img);
  @unlink($this->options['addfoto']['iimg'].$item->img);
  
 }
 
 protected function deletecategoryfiles()
 {
  
  $id = $this->itemparam;
  $item = ORM::factory($this->orm, $id);
  @unlink('public/usr/root/foto/imgcategories/'.$item->img);
  
 }
 
 
 public function action_addcategory()
 {
  
  $this->template->sitetitle .= '::Добавить категорию';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/CreateRecord');
  $middle = View::factory($this->cvpath.'Index');
  $this->template->middle = $middle;
 
 }
 
 public function action_editcategory()
 {
  
  $this->template->sitetitle .= '::Редактировать категорию';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/UpdateRecord');
  $itemid   = (int)$this->request->param('itemid', '1');
  $item  = ORM::factory('Catsfoto', $itemid);
  $data = array('id'         => $item->id,
                'title'      => $item->name,
                'desc'       => $item->description,
                'catdefault' => $item->catdefault,
                'icon'       => $item->img);
  $middle = View::factory($this->cvpath.'Index', $data);
  $this->template->middle = $middle;
  
 }
 
 public function action_editfoto()
 {
  
  $this->template->sitetitle .= '::Редактировать изображение';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/UpdateRecord');
  $itemid   = (int)$this->request->param('itemid', '0');
  $item  = ORM::factory('Foto', $itemid);
  $model = ORM::factory('Catsfoto');
  $results = $model->find_all();
  $categories = '';
  foreach($results as $result) :
   if($result->id == $item->catid) :
    $categories .= '<option selected="selected" value="'.$result->id.'">'.$result->name.'</option>';
   else :
    $categories .= '<option value="'.$result->id.'">'.$result->name.'</option>';
   endif;
  endforeach;
  $data = array('id'              => $item->id,
                'categories'      => $categories,
                'title'           => $item->name,
                'description'     => $item->description,
                'comments'        => $item->comments,
                'pathandfilename' => $this->options['addfoto']['iimg'].$item->img);
  $middle = View::factory($this->cvpath.'Index', $data);
  $this->template->middle = $middle;
 
 }
 
 public function action_addfoto()
 {
  
  //$this->tmpclean($this->param['ftmp']);
  //$this->tmpclean($this->param['itmp']);
  
   if($this->request->method() == 'POST') :
    if(isset($_POST['saveicon']) && $_POST['saveicon'] == '1') :
     $this->create();
    else :
     $this->uploadfoto();
    endif;
   else :
    $this->template->sitetitle .= '::Загрузить изображение';
    $this->tplactionmenu = 'ActionmenuUpload';
    $this->template->jsfunc = View::factory($this->cvpath.'Js/UploadImg');
    $this->template->middle = View::factory($this->cvpath.'Uploadfoto');
   endif;
 
 }
 
 protected function tmpclean($path)
 {
  
  $handle = opendir($path);
  while (($file = readdir($handle)) !== FALSE):
   @unlink($path.$file);
  endwhile;
 
 }
 
 protected function uploadfoto()
 {
  
  $view = View::factory($this->cvpath.'Cropfoto');
  $error_message = NULL;
  $filename = NULL;
  if (isset($_FILES['image'])):
   $filename = $this->_save_image($_FILES['image']);
  endif;
  if (!$filename) :
   $error_message = 'There was a problem while uploading the image. Make sure it is uploaded and must be JPG/PNG/GIF file.';
  endif;
 
  $view->uploaded_file = $this->param['ftmp'].$filename;
  $view->error_message = $error_message;
  $this->template->jslib .= '<script src="/public/js/jquery.jcrop.min.js"> </script>';
  $this->template->css   .= '<link rel="stylesheet" href="/public/css/jquery.jcrop.css" type="text/css" />';
  $this->template->sitetitle .= '::Создание иконки';
  $this->tplactionmenu = 'ActionmenuCrop';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/Crop');
  $this->template->middle = $view;
 
 }
 
 protected function _save_image($image)
 {
  
  if ( ! Upload::valid($image) OR ! Upload::not_empty($image) OR ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) :
   return FALSE;
  endif;
  
  $directory = DOCROOT.$this->param['ftmp'];
 
  if ($file = Upload::save($image, NULL, $directory)) :
   $filename = strtolower(Text::random('alnum', 20)).'.jpg';
   Image::factory($file)->resize(800, 800, Image::AUTO)->save($directory.$filename);
   unlink($file);
   return $filename;
  endif;
  return FALSE;
       
 }
 
 protected function create()
 {
  
  $image=Image::factory($_POST['image']);
  $image->crop($_POST['w'], $_POST['h'], $_POST['x'], $_POST['y']); 
  $image->resize(110, 110);
  $filename = basename($image->file);
  $image->save($this->param['itmp'].$filename,100);
  $this->template->sitetitle .= '::Создание записи изображения';
  $this->tplactionmenu = 'ActionmenuCreate';
  $this->template->jsfunc = View::factory($this->cvpath.'Js/CreateRecord');
  $middle = View::factory($this->cvpath.'Create');
  $middle->pathandfilename = $this->param['itmp'].$filename;
  $middle->filename = $filename;
  $model = ORM::factory('Catsfoto');
  $results = $model->find_all();
  $categories = '';
  foreach($results as $result) :
   $categories .= '<option value="'.$result->id.'">'.$result->name.'</option>';
  endforeach;
  $middle->categories = $categories;
  $this->template->middle = $middle;
  
 }
 
 protected function insertrecordcategory()
 {
  
  $post = Arr::map('trim', $_POST);
  
  if(!empty($post['icon'])) :
   $fotoid = ORM::factory('Foto', $post['icon']);
   if($fotoid->loaded()) :
    $newcategoryfile = 'public/usr/root/foto/imgcategories/'.$fotoid->img;
    $categoryfile = $fotoid->img;
    if(!file_exists($newcategoryfile)) :
     copy($this->options['addfoto']['iimg'].$fotoid->img, $newcategoryfile);
    endif;
   else :
    $categoryfile = 'default.jpg';
   endif;
  else :
   $categoryfile = 'default.jpg';
  endif;
  
  $catdefault = (!isset($post['first'])) ? 0 : 1;
  $model = ORM::factory($this->orm);
  if($catdefault == 1) :
   $results = $model->find_all();
   foreach($results as $result) :
    ORM::factory($this->orm, $result->id)->set('catdefault', 0)->update();
   endforeach;
  endif;
  
  $time = time(); 
  
  $data  = array('name'        => $post['title'],
                 'description' => $post['desc'],
                 'img'         => $categoryfile,
                 'catdefault'  => $catdefault,
                 'created'     => $time);
  
  $model->values($data)->create();
  
 }
 
 protected function insertrecordfoto()
 {
  
  $post  = Arr::map('trim', $_POST);
  $time  = time();
  $newname = $this->generate(6).$time.strrchr($post['imagesnames'], '.');
  if (!rename($this->options['addfoto']['ftmp'].$post['imagesnames'], $this->options['addfoto']['fimg'].$newname )) :
   //$this->log->add(LOG::ERROR,'Не удалось переместить файл изображения')->write();
  endif;
  
  if (!rename($this->options['addfoto']['itmp'].$post['imagesnames'], $this->options['addfoto']['iimg'].$newname )) :
   //$this->log->add(LOG::ERROR,'Не удалось переместить файл иконки')->write();
  endif;
  
  $model = ORM::factory($this->orm);
  $data = array('catid'       => $post['category'],
                'name'        => $post['title'],
                'description' => $post['desc'],
                'img'         => $newname,
                'full_img'    => $newname,
                'comments'    => (@$post['comments'] == 'on') ? 1 : 0,
                'uploaded'    => $time);
  $model->values($data)->create();
 
 }
 
 protected function updaterecordcategory()
 {
  
  $post  = Arr::map('trim', $_POST);
  
  $catdefault = (isset($post['first'])) ? 1 : 0;
  
  if($catdefault == 1) :
   $model = ORM::factory($this->orm);
   $results = $model->find_all();
   foreach($results as $result) :
    ORM::factory($this->orm, $result->id)->set('catdefault', 0)->update();
   endforeach;
  endif;
  
  $model = ORM::factory($this->orm, $post['id']);
  $data = array('name' => $post['title'],
                'description' => $post['desc'],
                'img'         => $post['icon'],
                'catdefault'  => $catdefault);
  $model->values($data)->update();
  
 }
 
 protected function updaterecordfoto()
 {
  
  $post  = Arr::map('trim', $_POST);
  $model = ORM::factory('Foto', $post['id']);
  $data = array('catid'       => $post['category'],
                'name'        => $post['title'],
                'description' => $post['desc'],
                'comments'    => (isset($post['comments'])) ? 1 : 0);
  $model->values($data)->update();
  
 }
 
 public function afterclient()
 {
  
  $this->bildmenu();
  
 }
 
}