<h1><?PHP echo $header; ?>:НОВЫЙ ПОЛЬЗОВАТЕЛЬ</h1>
<form id="formsubmit" method="POST" action="manager/users/userslist.html" autocomplete="off">
<div class="col w7">
 <div class="content">
  <div class="formobj">
   <label>Имя пользователя:</label><input type="text" name="username" class="text w_20" />
  </div>
  <div class="formobj">
   <label>Полное имя:</label><input type="text" name="fullname" class="text w_20" />
  </div>
  <div class="formobj">
   <label>Эл. почта:</label><input type="text" name="email" class="text w_20" />
  </div>
  <div class="formobj">
   <label>Пароль:</label><input type="password" name="password" class="text w_20" />
  </div>
  <div class="formobj">
   <label>Пароль ещё раз:</label><input type="password" name="passwordconfirm" class="text w_20" />
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
<input type="hidden" name="act" value="created" />
</form>