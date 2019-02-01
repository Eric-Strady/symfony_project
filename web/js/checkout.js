$(function(){
	$('footer').attr('class', 'footer fixed-bottom');

    // TOTAL PRICE = 0
    if (totalPrice === 0)
    {
        var message = '<span class="col-lg-12 alert alert-danger">Vous ne pouvez pas effectuer de réservation pour un montant de 0,00€.</span>';
        $('.icons:last').css('color', 'red');
        $('#confirmed').attr('class', 'btn btn-light btn-lg rounded-pill disabled');
        $('#orderSummary').append(message);
    }

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