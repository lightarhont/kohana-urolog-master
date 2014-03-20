<?php defined('SYSPATH') or die('No direct script access.');

$defaultsparam = array('controller' => 'Fotos');

$uri_prefix = 'manager/fotos/';

Route::set('categoriesfotosnew', $uri_prefix.'newcategory.html')
        ->defaults($defaults('addcategory'));

Route::set('categoriesfotosedit', $uri_prefix.'editcategory(/itemid-<itemid>).html', array("itemid" => "[0-9]+"))
        ->defaults($defaults('editcategory'));
                   
Route::set('fotosnew', $uri_prefix.'newfoto.html')
        ->defaults($defaults('addfoto'));

Route::set('fotosedit', $uri_prefix.'editfoto(/itemid-<itemid>).html', array('itemid' => '[0-9]+'))
        ->defaults($defaults('editfoto'));

Route::set('categoriesfotos', $uri_prefix.'categorieslist(/page-<page>).html')
        ->defaults($defaults('categorieslist'));

Route::set('fotos0', $uri_prefix.'fotoslist(/page-<page>).html', array('page' => '[0-9]'))
        ->defaults($defaults('fotoslist'));

Route::set('fotos', $uri_prefix.'fotoslist(/catid-<catid>(/page-<page>)).html', array('page' => '[0-9]'), array('catid' => '[0-9]'))
        ->defaults($defaults('fotoslist'));