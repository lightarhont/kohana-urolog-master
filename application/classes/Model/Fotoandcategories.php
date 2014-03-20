<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Fotoandcategories extends ORM {
 
 protected $_table_name  = 'fotos';
 protected $_primary_key = 'id';
 protected $_belongs_to = array(
        'catsfoto' => array(
            'model' => 'Catsfoto',
            'foreign_key' => 'catid',
            ),
        );
  
}