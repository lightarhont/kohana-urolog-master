<style>
   div.changepassword {
    float: left;
    clear: both;
    padding-left: 20px;
    padding-top: 10px;
   }
   
   div.changepassword a {
    color: darkred;
    font-weight: bold;
   }
   
   div.changepassword a:hover {
    text-decoration: none;
   }
   
   div.ifchangepassword {
    display: none;
   }
   
   span.generatepassword {
    padding-left: 20px;
   }
</style>
<h1><?PHP echo $header; ?>:РЕДАКТИРОВАТЬ ПОЛЬЗОВАТЕЛЯ</h1>
<form id="formsubmit" method="POST" action="manager/users/userslist.html" autocomplete="off">
<div class="col w7">
 <div class="content">
  <div class="formobj">
   <label>Имя пользователя:</label><input value="<?PHP echo $username; ?>" type="text" name="username" class="text w_20" />
  </div>
  <div class="formobj">
   <label>Полное имя:</label><input value="<?PHP echo $fullname; ?>" type="text" name="fullname" class="text w_20" />
  </div>
  <div class="formobj">
   <label>Эл. почта:</label><input value="<?PHP echo $email; ?>" type="text" name="email" class="text w_20" />
  </div>
  <div class="changepassword">
   <a href="javascript: void(0);">Изменить пароль:</a>
  </div>
  <div class="ifchangepassword">
   <div class="formobj">
    <label>Пароль:</label><input type="password" name="password" class="text w_20" /><span class="generatepassword"><a href="javascript: void(0);">Сгенерировать пароль:</a></span>
   </div>
   <div class="formobj">
    <label>Пароль ещё раз:</label><input type="password" name="passwordconfirm" class="text w_20" />
   </div>
  </div>
 </div> 
</div>
<div class="col w3 last">
 <div class="box header">
 <div class="head"><div></div></div>
 <h2>Роли</h2>
 <div class="desc">
  <?PHP echo $roles; ?>
 </div>
 <div class="bottom"><div></div></div>
</div> 
</div>
<input type="hidden" name="id" value="<?PHP echo $id; ?>" />
<input type="hidden" name="act" value="edited" />
</form>