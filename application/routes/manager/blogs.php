<?php defined('SYSPATH') or die('No direct script access.');

$defaultsparam = array('controller' => 'Blogs');

$uri_prefix = 'manager/blogs/';

Route::set('blogsnew', $uri_prefix.'newpost.html')
        ->defaults($defaults('addblog'));
        
Route::set('tagsnew', $uri_prefix.'newtag.html')
        ->defaults($defaults('addtag'));
        
Route::set('blogs', $uri_prefix.'blogslist(/page-<page>).html', array('page' => '[0-9]'))
        ->defaults($defaults('blogslist'));
        
Route::set('blogsedit', $uri_prefix.'editblog(/itemid-<itemid>).html', array('itemid' => '[0-9]+'))
        ->defaults($defaults('editblog'));

Route::set('tagsedit', $uri_prefix.'edittag(/itemid-<itemid>).html', array('itemid' => '[0-9]+'))
        ->defaults($defaults('edittag'));

Route::set('tags', $uri_prefix.'tagslist(/page-<page>).html', array('page' => '[0-9]'))
        ->defaults($defaults('tagslist'));

