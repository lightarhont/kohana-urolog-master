<?php defined('SYSPATH') or die('No direct script access.');

$defaultsparam = array('controller' => 'Comments');

$uri_prefix = 'manager/comments/';

Route::set('comments', $uri_prefix.'commentslist(/page-<page>).html', array('page' => '[0-9]'))
        ->defaults($defaults('commentslist'));

Route::set('commentsnew', $uri_prefix.'newcomment.html')
        ->defaults($defaults('addcomment'));

Route::set('commentsedit', $uri_prefix.'editcomment(/itemid-<itemid>).html', array('itemid' => '[0-9]+'))
        ->defaults($defaults('editcomment'));