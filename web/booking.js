$(function(){
	$('#step4').hide();
	$('#step5').hide();

    $('#visitorForm').click(function()
    {
        var nbVisitors = $('#louvre_bookingbundle_buyer_quantity').val();

        if (nbVisitors > 0 && nbVisitors < 30)
        {
            $('#step4').fadeIn('slow');
            var container = $('div#louvre_bookingbundle_buyer_bookings');
            var count = container.find(':input').length;

            addVisitorForm(container, nbVisitors);
        }
        else
        {
            alert('Vous devez sasir un nombre de visiteurs entre 0 et 30 !');
        }    	
    });

    function addVisitorForm(container, nbVisitors)
    {
        for (var i = 1; i <= nbVisitors; i++)
        {
            var builder = container.attr('data-prototype')
                .replace(/__name__label__/g, 'Visiteur n°' + (i))
                .replace(/__name__/g, i);

            var visitorForm = $(builder);

            container.append(visitorForm);
        } 
    }

    $('#emailForm').click(function()
    {
        $('#step5').fadeIn('slow');      
    });

});