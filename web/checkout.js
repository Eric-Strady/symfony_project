$(function(){ 
    // STRIPE
   
    var handler = StripeCheckout.configure({
        key: 'pk_test_tDb6XO0ZNEPKErPi5Qrzwyhh',
        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
        locale: 'auto',
        token: function(token) {
            // You can access the token ID with `token.id`.
            // Get the token ID to your server-side code for use.
        }
    });

    $('#paymentButton').click(function(e) {
      // Open Checkout with further options:
        handler.open({
            name: 'Musée du Louvre',
            description: 'Réservation pour ' + nbVisitor + ' personne(s)',
            zipCode: true,
            currency: 'eur',
            amount: amount
        });
        e.preventDefault();
    });

    // Close Checkout on page navigation:
    window.addEventListener('popstate', function() {
        handler.close();
    });
});