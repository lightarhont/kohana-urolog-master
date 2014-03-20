<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title><?PHP echo $sitetitle; ?></title>
		<link rel="stylesheet" href="/public/css/admincss/adminstyle.css" type="text/css" media="screen" charset="utf-8" />
                <?PHP echo $css; ?>
		<script src="/public/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/js/adminjs/global.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/js/adminjs/modal.js" type="text/javascript" charset="utf-8"></script>
                <?PHP echo $jslib; ?>
                
                <script type="text/javascript">
                    
                    <?PHP echo $js; ?>
                    
                </script>
                
                <base href="<?PHP echo $base; ?>">
	</head>
        
        <body>
            <div id="header">
                <div class="col w5 bottomlast">
				<span style="font-weight: bold; text-transform: uppercase;">Уролог-Андролог::Админ панель</span>
			</div>
			<div class="col w5 last right bottomlast">
				<p class="last">Авторизирован как <span class="strong"><?PHP echo $username; ?>,</span> <a href="manager/logout.html">Выход</a></p>
			</div>
			<div class="clear"></div>
</div>
<div id="wrapper">
	<div id="minwidth">
		<div id="holder">
			<div id="menu">
				<div id="left"></div>
				<div id="right"></div>
				<ul><?PHP echo $mainmenu; ?>
						</ul>
			</div>
			<div id="submenu">
				<?PHP echo $actionmenu; ?>
			</div>
			<div id="desc">
				<div class="body">
					
				 <?PHP echo $middle; ?>
                                 
				</div>
				<div class="clear"></div>
				<div id="body_footer">
					<div id="bottom_left"><div id="bottom_right"></div></div> The bottom left/right rounded corner
				</div>
			</div>
		</div>
	</div>
</div>
<div id="footer">
</div>
        </body>