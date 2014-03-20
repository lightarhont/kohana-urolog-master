<?php defined('SYSPATH') or die('No direct script access');

const MAINPATH = 'Manager/Blogs/';

return array(
             'blogslist' => array(
                                  'path' => MAINPATH.'Blogs/TableList/',
                                  'orm'  => 'Blogslistorm',
                                  'funcprefix' => 'post',
                                  'listlimit' => 30
                                  ),
             'tagslist'  => array('path' => MAINPATH.'Tags/TableList/',
                                  'orm'  => 'Tagsorm',
                                  'funcprefix' => 'tag',
                                  'listlimit' => 30
                                 ),
             'addtag'   => array('path' => MAINPATH.'Tags/AddTag/',
                                 'orm'  => 'Tagsorm'
                                 ),
             'addblog'   => array('path' => MAINPATH.'Blogs/AddBlog/',
                                  'orm'  => 'Blogslistorm'
                                  ),
             'edittag'  => array('path' => MAINPATH.'Tags/EditTag/',
                                  'orm'  => 'Tagsorm'
                                  ),
             'editblog'  => array('path' => MAINPATH.'Blogs/EditBlog/',
                                  'orm'  => 'Blogslistorm'
                                  ),
             );