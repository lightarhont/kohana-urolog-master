<?php defined('SYSPATH') OR die('No direct script access.');

class Form extends Kohana_Form {

 	public static function input($name, $value = NULL, array $attributes = NULL)
	{
		// Set the input name
		$attributes['name'] = $name;

		// Set the input value
		$attributes['value'] = $value;

		if ( ! isset($attributes['type']))
		{
			// Default type is text
			$attributes['type'] = 'text';
		}

		return '<div id="lvl1"><div id="lvl2"><div id="lvl3"><div id="lvl4"><input'.HTML::attributes($attributes).' /></div></div></div></div>';
	}
	
	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		$attributes['type'] = 'password';

		return Form::input($name, $value, $attributes);
	}
	
	public static function formsubmit($textbutton, $formid) {
	
	 return '<div class="btn1"  onclick="document.getElementById(\''.$formid.'\').submit()"><div class="btn2"><div class="btn3"><div class="btn4">'.$textbutton.'</div></div></div></div>';
	}
	
	public static function formsubmitfunc($textbutton, $funcid, $func='submitfunc') {
	
	 if($funcid == '') {
	  $param = '';
	 }
	 else {
	  $param = "'".$funcid."'";	
	 }
	 return '<div class="btn1"  onclick="'.$func.'('.$param.')"><div class="btn2"><div class="btn3"><div class="btn4">'.$textbutton.'</div></div></div></div>';
	}
	
	public static function formsubmitajax($textbutton, $funcid) {
	
	 return '<div class="btn1"  onclick="submitajax(\''.$funcid.'\')"><div class="btn2"><div class="btn3"><div class="btn4">'.$textbutton.'</div></div></div></div>';
	}

}