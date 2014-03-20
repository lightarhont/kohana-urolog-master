<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tagsorm extends ORM {
    
 protected $_table_name  = 'tags';
 
 protected $_has_many = array(
      'blogslist'  => array(
               'model'   => 'Blogslistorm',
               'foreign_key' => 'tag_id',
               'far_key' => 'blog_id',
               'through' => 'tagsblogs',
          )
    );
    
}