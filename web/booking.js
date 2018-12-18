$(function(){
	$('#step4').hide();
	$('#step5').hide();

    $('#visitorForm').click(function()
    {
        var container = $('div#louvre_bookingbundle_buyer_bookings');
        var count = container.children('div').length;
        var nbVisitors = $('#louvre_bookingbundle_buyer_quantity').val();

        if (count > 0)
        {
            if (nbVisitors > count)
            {
                addVisitorForm(nbVisitors, count, container);
            }
            else
            {
                deleteVisitorForm(nbVisitors, count, container);
            }
        }
        else
        {
            if (nbVisitors > 0 && nbVisitors < 30)
            {
                $('#step4').fadeIn('slow');
                
                addVisitorForm(nbVisitors, count, container);
            }
            else
            {
                alert('Vous devez sasir un nombre de visiteurs entre 0 et 30 !');
            } 
        }   	
    });

    function addVisitorForm(nbVisitors, count, container)
    {
        for (count; count < nbVisitors; count++)
        {
            var builder = container.attr('data-prototype')
                .replace(/__name__label__/g, 'Visiteur n°' + (count+1))
                .replace(/__name__/g, (count+1));

            var visitorForm = $(builder);

            container.append(visitorForm);
        } 
    }

    function deleteVisitorForm(nbVisitors, count, container)
    {
        for (nbVisitors; nbVisitors < count; nbVisitors++)
        {
            container.children('div').last().remove();
        }
    }

    $('#emailForm').click(function()
    {
        $('#step5').fadeIn('slow');      
    });

});