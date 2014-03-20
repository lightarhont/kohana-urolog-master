<h1><?PHP echo $header; ?>:НОВЫЙ ПОЛЬЗОВАТЕЛЬ</h1>
<form id="formsubmit" method="POST" action="" autocomplete="off">
<div class="col w7">
 <div class="content">
  <div class="formobj">
   <label>Имя пользователя:</label><input value="<?PHP echo $post['username']; ?>" type="text" name="username" class="text w_20" />
   <?PHP if(isset($errors['username'])) : ?>
   <div class="fielderror"><?PHP echo $errors['username']; ?></div>
   <?PHP endif; ?>
  </div>
  <div class="formobj">
   <label>Полное имя:</label><input value="<?PHP echo $post['fullname']; ?>" type="text" name="fullname" class="text w_20" />
   <?PHP if(isset($errors['fullname'])) : ?>
   <div class="fielderror"><?PHP echo $errors['fullname']; ?></div>
   <?PHP endif; ?>
  </div>
  <div class="formobj">
   <label>Эл. почта:</label><input value="<?PHP echo $post['email']; ?>" type="text" name="email" class="text w_20" />
   <?PHP if(isset($errors['email'])) : ?>
   <div class="fielderror"><?PHP echo $errors['email']; ?></div>
   <?PHP endif; ?>
  </div>
  <div class="formobj">
   <label>Пароль:</label><input value="" type="password" name="password" class="text w_20" />
   <?PHP if(isset($errors['password'])) : ?>
   <div class="fielderror"><?PHP echo $errors['password']; ?></div>
   <?PHP endif; ?>
  </div>
  <div class="formobj">
   <label>Пароль ещё раз:</label><input value="" type="password" name="passwordconfirm" class="text w_20" />
   <?PHP if(isset($errors['passwordconfirm'])) : ?>
   <div class="fielderror"><?PHP echo $errors['passwordconfirm']; ?></div>
   <?PHP endif; ?>
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