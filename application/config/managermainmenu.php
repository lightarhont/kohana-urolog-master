<?php defined('SYSPATH') or die('No direct script access');

const MANAGER = 'manager/';

return array(
             0 => array('url'   => 'index.html',
                        'title' => 'Обо мне'),
             1 => array('url'   => MANAGER.'blogs/blogslist.html',
                        'title' => 'Блог'),
             2 => array('url'   => MANAGER.'fotos/fotoslist.html',
                        'title' => 'Фото'),
             3 => array('url'   => 'index.html',
                        'title' => 'Видео'),
             4 => array('url'   => 'index.html',
                        'title' => 'Вопросы'),
             5 => array('url'   => 'index.html',
                        'title' => 'Каталог'),
             6 => array('url'   => MANAGER.'users/userslist.html',
                        'title' => 'Пользователи'),
             7 => array('url'   => MANAGER.'comments/commentslist.html',
                        'title' => 'Комментарии'),
             );