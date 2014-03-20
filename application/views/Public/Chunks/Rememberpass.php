<div class="rememberform">
 <h3>Сброс пароля:</h3>
 <p>Достаточно знать имя пользователя или email для сброса пароля!</p>
 <?PHP echo Form::open('rememberpasswordpost.html', array('method' => 'post', 'id' => 'rememberform')); ?>
 <div class="username-field"><?PHP echo Form::label('username', 'Имя пользователя:').Form::input('username', $value_username); ?><div class="error"><?PHP echo $error_username; ?></div></div>
 <div class="email-field"><?PHP echo Form::label('email', 'Электронная почта:').Form::input('email', $value_email); ?><div class="error"><?PHP echo $error_email; ?></div></div>
<script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({disabledSubmit:false,autoRevert:true,autoSubmit:false});
  });
</script>
 <div class="clr"></div>
 <div class="QapTcha-desc">Система защиты: <?PHP echo $error_qaptcha; ?></div>
 <div class="QapTcha"></div>
 <div class="submit-button"><?PHP echo Form::formsubmit('Далее', 'rememberform'); ?></div>
 <?PHP echo Form::close(); ?>
</div>