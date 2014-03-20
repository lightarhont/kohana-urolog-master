<div class="registrationform">
 <h3>Регистрация:</h3>
 <p>Все поля обязательны для заполнения!</p>
 <?PHP echo Form::open('registrationpost.html', array('method' => 'post', 'id' => 'registrationform')); ?>
 <div class="fullname-field"><?PHP echo Form::label('fullname', 'Полное имя:').Form::input('fullname', $value_fullname); ?><div class="error"><?PHP echo $error_fullname; ?></div></div>
 <div class="username-field"><?PHP echo Form::label('username', 'Имя пользователя:').Form::input('username', $value_username); ?><div class="error"><?PHP echo $error_username; ?></div></div>
 <div class="password-field"><?PHP echo Form::label('password', 'Пароль:').Form::password('password', ''); ?><div class="error"><?PHP echo $error_password; ?></div></div>
 <div class="password2-field"><?PHP echo Form::label('passwordconfirm', 'Подвердите пароль:').Form::password('passwordconfirm', ''); ?><div class="error"><?PHP echo $error_passwordconfirm; ?></div></div>
 <div class="email-field"><?PHP echo Form::label('email', 'Электронная почта:').Form::input('email', $value_email); ?><div class="error"><?PHP echo $error_email; ?></div></div>
 <script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({disabledSubmit:false,autoRevert:true,autoSubmit:false});
  });
</script>
 <div class="clr"></div>
 <div class="QapTcha-desc">Система защиты: <?PHP echo $error_qaptcha; ?></div>
 <div class="QapTcha"></div>
 <div class="submit-button"><?PHP echo Form::formsubmit('Далее', 'registrationform'); ?></div>
 <?PHP echo Form::close(); ?>
</div>