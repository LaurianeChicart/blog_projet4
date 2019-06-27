$(".warnComment").click(function(e){
	e.preventDefault();
	let $selection = $(this);
	let url = $selection.attr('href');

	$.ajax(url, {
		success: function() {
		   	$selection.replaceWith("<p class='text-primary'><span class='fas fa-check-circle'></span> Commentaire signalé</p>");
		},
		error: function(jqxhr) {
		    alert(jqxhr.responseText);
		}
	});
	  
});

$("#contact form").submit(function(e){
	e.preventDefault();
	window.scrollTo(0, 0);
	let urlForm = 'send-mail.html';
	let regexCourriel = /.+@.+\..+/;
	
    let nameForm = $("#contact form #name").val();
    let mailForm = $("#contact form #mail").val();
    let subjectForm = $("#contact form #subject").val();
    let messageForm = $("#contact form #message").val();
    $("#jsmessage" ).empty();
    $("#jsmessage" ).removeClass();

    if (nameForm.trim() === '')
    {
        $("#jsmessage").text('Saisie du nom incorrecte');
        $("#jsmessage").addClass("alert alert-danger");
    }
    else if(!regexCourriel.test(mailForm))
    {
    	$("#jsmessage").text('Saisie du mail incorrecte');
        $("#jsmessage").addClass("alert alert-danger");
    }
    else if (subjectForm.trim() === '')
    {
    	$("#jsmessage").text('Saisie de l\'objet incorrecte');
        $("#jsmessage").addClass("alert alert-danger");
   	}
    else if (messageForm.trim() === '')
    {
    	$("#jsmessage").text('Saisie du message incorrecte');
        $("#jsmessage").addClass("alert alert-danger");
    }
    else
    {
    	
    	$.ajax({
    		method: "POST",
    		url: urlForm,
    		data: {name: nameForm, mail: mailForm, subject: subjectForm, message: messageForm}
    	})
			.done(function() {
			   	$("#jsmessage").addClass("alert alert-primary");
    			$("#jsmessage").replaceWith('<p class="alert alert-primary font-weight-bold" id="jsmessage"><span class="fas fa-check"> </span> Mail envoyé</p>');
			});
	}

	  
});



$('#dialog-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 
  var message = button.data('message');
  var link = button.data('link');
  var id = button.data('id');

  var modal = $(this);

   	modal.find('#message').text(message);
   	modal.find('#formDelete').attr("action", link);
   	modal.find('#id').val(id);
  
});

