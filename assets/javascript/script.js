$(".warnComment").click(function(e){
	e.preventDefault();
	console.log('a');
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

