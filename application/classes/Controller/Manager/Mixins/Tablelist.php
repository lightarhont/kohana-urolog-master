<?php defined('SYSPATH') or die('No direct script access.');

trait deleteitem {
 
 protected function deleteitem($id)
 {
  
  try {
   $model = ORM::factory($this->orm, $id);
   $model->delete();
   return 'Itemid-'.$id.', ';
  }
  catch(Kohana_Exception $e) {
   return $e;
  }
 
 }
 
}

trait updateorder {
 
 protected function updateorder($id, $order)
 {
  
  try {
   $model = ORM::factory($this->orm, $id);
   $model->set('order', $order)->update();
   return 'Itemid-'.$id.', ';
  }
  catch(Kohana_Exception $e) {
   return $e;
  }
 }
 
}

trait tablelist {
 use deleteitem, updateorder;
 
 protected $itemparam;
 
 protected function bildtablejs()
 {
  
  $this->template->js .= View::factory($this->chunkspath.'Tablelist/Js/SelectAll');
  $this->template->jsfunc .= View::factory($this->chunkspath.'Tablelist/Js/Func');
  
 }
 
 protected function actionmessager($actionresult, $type='success')
 {
  
  $this->template->js .= "$('#actionmessage').Message({type:'".$type."',time:10000,text: '".rtrim($actionresult, ', ')."',target:'#actionmessage',click:true});";
 
 }
 
 protected function posttablelist($post)
 {
  
  $arrayitems = function($post) {
   
   $result = array();
   foreach($post as $key=>$value):
    if(preg_match('(^itemid-[0-9])', $key)) :
     $result[] = str_replace('itemid-', '', $key);
    endif;
   endforeach;
   return $result;
   
  };
  
  $funcact = function($act)
  {
   
   $method = (string)(isset($this->param[$act])) ?  $this->param[$act] : FALSE;
   if(method_exists($this, $method)) :
    $this->$method();
   endif;
   
  };
  
  $result = '';
  switch($post['act']):
   
   case 'order':
    $items = $arrayitems($post);
    $actresult = 'Порядок обновлён: ';
    foreach($items as $key=>$value):
     $this->itemparam = array('id' => $value, 'order' => $post['order-'.$value]);
     $funcact('ord');
     $result0 = $this->updateorder($value, $post['order-'.$value]);
     if(!is_object($result0)) :
      $result .= $result0;
     else :
      $error = 'error';
      $actresult = 'Произошла ошибка: ';
      $result .= '<br />Текст ошибки: '.$result0->getMessage().'<br />';
     endif;
    endforeach;
    $actresult = $actresult.$result;
    if(!isset($error)):
     $this->actionmessager($actresult);
    else :
     $this->actionmessager($actresult, $error);
    endif;
    break;
   case 'delete':
    $items = $arrayitems($post);
    $actresult = 'Элементы удалены: ';
    foreach($items as $key=>$value):
     $this->itemparam = $value;
     $funcact('del');
     $result0 = $this->deleteitem($value);
     if(!is_object($result0)) :
      $result .= $result0;
     else :
      $error = 'error';
      $actresult = 'Произошла ошибка: ';
      $result .= '<br />Текст ошибки: '.$result0->getMessage().'<br />';
     endif;
    endforeach;
    $actresult = $actresult.$result;
    if(!isset($error)):
     $this->actionmessager($actresult);
    else :
     $this->actionmessager($actresult, $error);
    endif;
   break;
   case 'created' :
    $this->actionmessager('Добавлено!');
    $method = 'insertrecord'.((isset($this->param['funcprefix'])) ? $this->param['funcprefix'] : FALSE) ;
    if(method_exists($this, $method)):
     $this->$method();
    endif;
   break;
   case 'edited' :
    $this->actionmessager('Отредатировано!');
    $method = 'updaterecord'.((isset($this->param['funcprefix'])) ? $this->param['funcprefix'] : FALSE) ;
    if(method_exists($this, $method)):
     $this->$method();
    endif;
   break;
   
  endswitch;
 
 }
 
}