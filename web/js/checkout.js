$(function(){
	$('footer').attr('class', 'footer fixed-bottom');

    // STRIPE
    $('#payment').hide();

    $('#confirmed').click(function() {
    	$('#decision').hide();
    	$('.icons').css('color', '#43a526');
		$('#payment').fadeIn('slow');
	});

    $('.stripe-button-el').attr('id', 'stripeButton');
    $('#stripeButton').attr('class', 'btn btn-primary');
    $('#stripeButton span').replaceWith('Payer ma réservation');
});