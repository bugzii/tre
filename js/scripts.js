$( document ).ready(function() {
	$('#search').click(function() {
		var page = $('#page').val();
		var stash = $("form").serialize();
		console.log(stash);
		$.get( "data/"+page+".php", $("form").serialize(), function( data ) {
			  console.log( "Data Loaded: " + data );
			  $('#result').empty().append(data);
		});
	});
	$(".fancybox").fancybox();
});
$(document).ajaxStart(function () {
	    $("#loading").show();
});

$(document).ajaxComplete(function () {
	    $("#loading").hide();
});
