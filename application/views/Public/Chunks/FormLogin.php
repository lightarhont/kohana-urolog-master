<div class="formlogin">
 <div class="formlogin1">
 <!--Вход через социальные сети-->

 </div>
 <div class="formlogin2">
  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="loginform">
   <div class="userlogin"><input name="username" type="text" /></div>
   <div class="userpass"><input name="password" type="password" /></div>
   <input type="hidden" name="loginurl" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
   <input type="hidden" name="login" value="true" />
   <div class="tologin"><input type="submit" value="войти" /></div>
  </form>
  </div>
  <div class="formlogin3"><ul><li><a href="/rememberpassword.html">Напомнить пароль</a></li><li><a href="/registration.html">Создать учётную запись</a></li></ul></div>
 </div>