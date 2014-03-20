<?php defined('SYSPATH') or die('No direct script access');

const MAINPATH = 'Manager/Fotos/';

return array(
             'fotoslist'      => array(
                                       'path' => MAINPATH.'Fotos/TableList/',
                                       'orm'  => 'Fotoandcategories',
                                       'del' => 'deletefotofiles',
                                       'funcprefix' => 'foto',
                                       'listlimit' => 30
                                      ),
             'categorieslist' => array(
                                       'path' => MAINPATH.'Categories/TableList/',
                                       'orm'  => 'Catsfoto',
                                       'del'  => 'deletecategoryfiles',
                                       'funcprefix' => 'category',
                                       'listlimit' => 30
                                      ),
             'addfoto'        => array(
                                       'path' => MAINPATH.'Fotos/AddFoto/',
                                       'orm'  => 'Foto',
                                       'ftmp' => 'tmp/uploadimges/fullimg/',
                                       'itmp' => 'tmp/uploadimges/icon/',
                                       'fimg' => 'public/usr/root/foto/fullimgs/',
                                       'iimg' => 'public/usr/root/foto/icons/'
                                      ),
             'editfoto'       => array(
                                       'path' => MAINPATH.'Fotos/EditFoto/',
                                       'orm'  => ''
                                       ),
             'addcategory'    => array('path' => MAINPATH.'Categories/AddCategory/',
                                       'orm'  => ''),
             'editcategory'   => array('path' => MAINPATH.'Categories/EditCategory/',
                                       'orm'  => '')
                );