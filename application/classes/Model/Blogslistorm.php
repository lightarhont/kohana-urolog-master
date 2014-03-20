<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blogslistorm extends ORM {
    
 protected $_table_name  = 'blogs';
 
 protected $_has_many = array(
      'tags'  => array(
               'model'   => 'Tagsorm',
               'foreign_key' => 'blog_id',
               'far_key' => 'tag_id',
               'through' => 'tagsblogs',
          )
    );
    
}