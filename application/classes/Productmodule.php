<?php defined('SYSPATH') OR die('No direct script access.');

class Productmodule {
 
 public static function getproduct() {
  $model = ORM::factory('Blogslistorm');
  $result = $model->find_all();
  return $result[0]->title;
 }
 
}