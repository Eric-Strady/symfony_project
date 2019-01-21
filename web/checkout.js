$(function(){
	$('footer').attr('class', 'footer fixed-bottom');

    // STRIPE
    $('.stripe-button-el').attr('id', 'stripeButton');
    $('#stripeButton').attr('class', 'btn btn-primary');
    $('#stripeButton span').replaceWith('Payer ma réservation');
});