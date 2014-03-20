<?php defined('SYSPATH') OR die('No direct script access.');

class HTML extends Kohana_HTML {
    
    public static function wysiwyg($name, $value = '', $css = '/css/ckeditor.css', $height = '260', $width = '98%')
	{
		$url_base = URL::base();
	
		$path = 'vendor/';
		
		include_once(DOCROOT.$path.'ckeditor/ckeditor.php');
		include_once(DOCROOT.$path.'ckfinder/ckfinder.php');
	
		$CKEditor = new CKEditor();
		$CKEditor->basePath = $url_base.$path.'ckeditor/';
	
		$CKEditor->config['height'] = $height . 'px';
		$CKEditor->config['width']  = $width;
	
		$CKEditor->config['filebrowserBrowseUrl']      = $url_base.$path.'ckfinder/ckfinder.html';
		$CKEditor->config['filebrowserImageBrowseUrl'] = $url_base.$path.'ckfinder/ckfinder.html?type=Images';
		$CKEditor->config['filebrowserFlashBrowseUrl'] = $url_base.$path.'ckfinder/ckfinder.html?type=Flash';
		$CKEditor->config['filebrowserUploadUrl']      = $url_base.$path.'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$CKEditor->config['filebrowserImageUploadUrl'] = $url_base.$path.'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$CKEditor->config['filebrowserFlashUploadUrl'] = $url_base.$path.'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	
		$config['uiColor'] = '#efefef';
		
		$config['contentsCss'] = $css;
	
		// Кнопки (добавляем/убираем)
		$config['toolbar'] = array(
			array('Source','-', 'Maximize', 'ShowBlocks'),
			array('Cut','Copy','Paste','PasteText','PasteFromWord'),
			array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
			array('Link','Unlink','Anchor'),
			array('Image','Table','HorizontalRule','SpecialChar','PageBreak'),
			'/',
			array('Format', 'Bold','Italic','Underline','Strike',),
			array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList'),
			array('Outdent','Indent','-','TextColor','BGColor','-','Subscript','Superscript'),
			array('uiColor')
		);
	
		ob_start();
		$CKEditor->editor($name, $value, $config);
		return ob_get_clean();
	}
}