<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Foto extends Controller {
 
 //Рабочие переменные
 protected $imgcategories = '/public/usr/root/foto/imgcategories/';
 protected $icons = '/public/usr/root/foto/icons/';
 protected $albumslistlimit = '4';
 protected $categorylistlimit = '20';

 //Работа с категориями
 public function action_categories() {
  $limit = $this->albumslistlimit;
  $page = $this->request->param('page', '1');
  $offset = $limit*$page-$limit;
  $catfoto     = ORM::factory('Catsfoto');
  $categories  = $catfoto
                 ->limit($limit)
				 ->offset($offset)
                 ->find_all();
  $total_items = $catfoto->count_all();
  $response = '';
  foreach($categories as $category) {
   $response .= '<div class="category">';
   $response .= '<img src="'.$this->imgcategories;
   $response .= $category->img;
   $response .= '" />';
   $response .= '<div class="also">';
   $response .= '<div class="cat-title">';
   $response .= '<a href="javascript: void(0);" onclick="getcatidimages(';
   $response .= "'".$category->id."'";
   $response .= ');">';
   $response .= $category->name;
   $response .= '</a>';
   $response .= '</div>';
   $response .= '<div class="description">';
   $response .= $category->description;
   $response .= '</div>';
   $response .= '</div>';
   $response .= '</div>';
  }
  $pagination = Pagination::factory(array('total_items' => $total_items, 'view' => 'pagination/custom1', 'items_per_page' => $limit));
  $response .= '<div class="pagination">'.$pagination.'</div>';
  $this->response->body($response);
 }
 
 //Дефолтная категория 
 public function action_defcategory() {
  
  $total_fotos = $this->deffotoscount();
  $fotos = Model::factory('Showcatfoto')->get_deffotos($this->categorylistlimit);
  $this->category($fotos, $total_fotos);
 }
 
 //Категория по catid
 public function action_idcategory() {
  $catid = $this->request->param('catid', '0');
  if ($catid == 0) {
   $fotos = Model::factory('Showcatfoto')->get_deffotos($this->categorylistlimit);
  }
  else {
   $fotos = Model::factory('Showcatfoto')->get_catidfotos($catid, $this->categorylistlimit);
  }
  $this->validation($fotos);
 }
 
 //Педжинация категории
 public function action_pagescategory() {
  $catid = $this->request->param('catid', '0');
  $page = $this->request->param('page', '1');
  $total = $this->request->param('total', '0');
  $offset = $this->categorylistlimit*$page-$this->categorylistlimit;
  $fotos = Model::factory('Showcatfoto')->get_pages_fotos($catid, $offset, $this->categorylistlimit);
  $this->paginationfotos($fotos, $total);
  //$this->response->body(var_dump($fotos));
 }
  
 protected function deffotoscount() {
  $counts = Model::factory('Showcatfoto')->get_deffotos_count();
  $total = 0;
  foreach ($counts as $count) {
   $total += $count->total_fotos; 
  }
  
  return $total;
 }
 
 protected function fotoscount($catid) {
  $counts = Model::factory('Showcatfoto')->get_fotos_count($catid);
  $total = 0;
  foreach ($counts as $count) {
   $total += $count->total_fotos; 
  }
  
  return $total;
 }
 
 //Валидатор
 protected function validation($fotos) {
  if(isset($fotos[0]->catname)) {
   $total = $this->fotoscount($fotos[0]->catid);
   $this->category($fotos, $total);
  }
  else {
   $message = '<div class="message">В данной категории нет изображений</div>';
   $this->response->body($message);
  }
 } 
 
 //Распечатка категории
 protected function category($fotos, $total) {
  
  $album = ' <div class="aboutcategory">
  <div class="thistitle">'.$fotos[0]->catname.'</div>
  <div class="thisdesc">'.$fotos[0]->catdesc.'</div>
  </div>';
  
  $this->paginationfotos($fotos, $total, $album);
 }
 
 //Распечатка части с педжинацией
 protected function paginationfotos($fotos, $total, $album='') {
   $album .= '<div id="contentcategory" class="contentcategory">
 <div id="pagesloading" class="images">';
 
  foreach ($fotos as $foto) {
   $album .= '<a target="_blank" href="/showfoto/id-'.$foto->id.'.html" class="icn"><img title="'.$foto->name.'" alt="'.$foto->name.'" src="'.$this->icons;
   $album .= $foto->img;
   $album .= '" /></a>';
  }
  $album .= '</div>';
  $json = json_encode(array('catid' => $fotos[0]->catid, 'total' => $total));
  $album .= '<div id="hiddencatid">'.$json.'</div>';
  $album .= '<div class="pagination">';
  $pagination = Pagination::factory(array('total_items' => $total, 'view' => 'pagination/custom2', 'items_per_page' => $this->categorylistlimit));
  $album .= $pagination;
  $album .= '</div>';
  $album .= '</div>';
  $this->response->body($album);
 } 
 
}