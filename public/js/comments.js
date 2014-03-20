function citeauthor(id) {
 var usercomment  = $('#uc'+id).html();
 var datecomment  = $('#dc'+id).html();
 var titlecomment = '<strong>'+$('#tc'+id).html()+'</strong>';
 var bodycomment  = $('#bc'+id).html();
 var text = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>' + usercomment + '&nbsp;[' + datecomment + ']&nbsp;пишет:</i><br /><br />' + titlecomment + '<br />' + bodycomment;
 $('#wbbeditor').execCommand('quote',{seltext:text});
}

function editcomment(id) {
 
 $.post('requesteditcomment.html',
    { idcomment: id },
	function(data) {
	  var obj = $.parseJSON(data);
	  
	  var clear = "'clear'";
	  var updatecomment = "'updatecomment'";
	  $('.submit-button').html('<div style="float:left; margin-right:10px;"><div class="btn1"  onclick="submitajax(' + clear + ')"><div class="btn2"><div class="btn3"><div class="btn4">Отмена</div></div></div></div></div> <div style="float:left;"><div class="btn1"  onclick="submitajax(' + updatecomment + ')"><div class="btn2"><div class="btn3"><div class="btn4">Отредактировать</div></div></div></div></div>');
	  
	  $('.titlecomment input').val(obj.title);
	  $('#updateid').val(obj.id);
	  $("#wbbeditor").htmlcode(obj.comment);
	  $("#wbbeditor").bbcode(obj.comment);
	  
	 }
	);
 
}

function submitajax(mode) {
 
 if(mode == 'adcomment') {
  $('#wbbeditor').sync();
 
  var titleis     = $('.titlecomment input').val();
  var commentis   = $('.bodycomment textarea').val();
  var comidis     = $('#componentid').val();
  var conttitleis = $('#titlecontent').val();
  var useridis    = $('#userid').val();
  $.post('commentpost.html',
    { title: titleis, comment: commentis, userid: useridis, comid: comidis, conttitle: conttitleis },
    function(data){
     if(data == 'Комментарий успешно добавлен!') {
	  var resultopt = '<div class="success">Успешно:</div>';
	  $('#adcomment').css('display', 'none');
	  $('#messagertimer').css('display', 'block');
	  commentsload();
	  setTimeout(comentreadyclear, 3000);
	 }
	 else {
	  var resultopt = '<div class="error">Ошибка:</div>';
	 }
     var result = '<div class="box-modal" id="box-modal"><div class="box-modal_close arcticmodal-close">закрыть</div><div class="message-box-modal">'+ resultopt +'<div>' + data + '</div></div>';
    $('#result').html(result);
	 $('#box-modal').arcticmodal({
      closeOnEsc: false,
      closeOnOverlayClick: false,
      overlay: {
        css: {
            backgroundColor: '#fff',
            backgroundImage: 'url(images/overlay.png)',
            backgroundRepeat: 'repeat',
            backgroundPosition: '50% 0',
            opacity: .75
        }
       }
      });
    }
   );
  }
  
  if(mode == 'updatecomment') {
   $('#wbbeditor').sync();
 
   var titleis      = $('.titlecomment input').val();
   var commentis    = $('.bodycomment textarea').val();
   var comidis      = $('#componentid').val();
   var conttitleis = $('#titlecontent').val();
   var useridis     = $('#userid').val();
   var updateidis   = $('#updateid').val();
   
   $.post('responseeditcomment.html',
   { id: updateidis, title: titleis, comment: commentis, userid: useridis, comid: comidis, conttitle: conttitleis },
    function(data){
	 if(data == 'Комментарий успешно отредактирован!') {
	  var resultopt = '<div class="success">Успешно:</div>';
	  $('#adcomment').css('display', 'none');
	  $('#messagertimer').css('display', 'block');
	  commentsload();
	  setTimeout(comentreadyclear, 3000);
	 }
	 else {
	  var resultopt = '<div class="error">Ошибка:</div>';
	 }
     var result = '<div class="box-modal" id="box-modal"><div class="box-modal_close arcticmodal-close">закрыть</div><div class="message-box-modal">'+ resultopt +'<div>' + data + '</div></div>';
    $('#result').html(result);
	 $('#box-modal').arcticmodal({
      closeOnEsc: false,
      closeOnOverlayClick: false,
      overlay: {
        css: {
            backgroundColor: '#fff',
            backgroundImage: 'url(images/overlay.png)',
            backgroundRepeat: 'repeat',
            backgroundPosition: '50% 0',
            opacity: .75
        }
       }
      });
    }
   );
  
  }
  
  if(mode == 'clear') {
   resetformsubmit();
  }

}

function resetformsubmit() {
 
 var adcomment = "'adcomment'";
 $('.submit-button').html('<div class="btn1"  onclick="submitajax(' + adcomment + ')"><div class="btn2"><div class="btn3"><div class="btn4">Оставить комментарий</div></div></div></div>');
 $('.titlecomment input').val('');
 $('#updateid').val('0');
 $("#wbbeditor").htmlcode('');
 $("#wbbeditor").bbcode('');
 
}

function comentreadyclear() {
	 
  	 $('#adcomment').css('display', 'block');
	 $('#messagertimer').css('display', 'none');
	 
	 var adcomment = "'adcomment'";
     $('.submit-button').html('<div class="btn1"  onclick="submitajax(' + adcomment + ')"><div class="btn2"><div class="btn3"><div class="btn4">Оставить комментарий</div></div></div></div>');
     $('#updateid').val('0');
	 
	 $('.titlecomment input').val('');
	 $('.bodycomment textarea').val('');
	 
	 $("#wbbeditor").htmlcode('');
	 $("#wbbeditor").bbcode('');


}

function deletecommentconfirm (commentid) {
 resetformsubmit();
 var id = "'" + commentid + "'";
 var result = '<div class="box-modal" id="delete-box-modal"><div class="title-delete-box-modal">Комментарий будет удалён безвозвратно, продолжить?</div><div class="buttons-delete-box-modal"><div class="yes-button"><div class="btn1"  onclick="deletecomment(' + id + ')"><div class="btn2"><div class="btn3"><div class="btn4">Да</div></div></div></div></div><div class="no-button"><div class="btn1"  onclick="closearctic()"><div class="btn2"><div class="btn3"><div class="btn4">Отмена</div></div></div></div></div></div></div>';
 
 $('#result').html(result);
 $('#delete-box-modal').arcticmodal({
    closeOnEsc: false,
    closeOnOverlayClick: false,
    overlay: {
        css: {
            backgroundColor: '#fff',
            backgroundImage: 'url(images/overlay.png)',
            backgroundRepeat: 'repeat',
            backgroundPosition: '50% 0',
            opacity: .75
        }
    }
  });
}

function closearctic() {
 $.arcticmodal('close');
}



function deletecomment(commentid) {
   closearctic();
   $.post('deletecomment.html',
   { id: commentid },
   function(data){
    var result = '<div class="box-modal" id="box-modal"><div class="box-modal_close arcticmodal-close">закрыть</div><div class="message-box-modal"><div class="success">Успешно:</div><div>' + data + '</div></div>';
    $('#result').html(result);
	 $('#box-modal').arcticmodal({
      closeOnEsc: false,
      closeOnOverlayClick: false,
      overlay: {
        css: {
            backgroundColor: '#fff',
            backgroundImage: 'url(images/overlay.png)',
            backgroundRepeat: 'repeat',
            backgroundPosition: '50% 0',
            opacity: .75
        }
       }
      });
	commentsload();
	}
   );
}

  
  function pages (page) {
  var obj = $.parseJSON($('#hiddencomponentid').text());
  $('#allcomments').load('/comments/'+obj.componentid+'/'+page+'/'+obj.total);
  }