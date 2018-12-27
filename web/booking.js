$(function(){
	$('#step4').hide();
	$('#step5').hide();

    $.datepicker.regional['fr'] = {
        dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
        dayNamesShort: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
        dayNamesMin: ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'],
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Févr', 'Mar', 'Avr', 'Mai', 'Jun', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        dateFormat: 'dd/mm/yy'
    };

    $.datepicker.setDefaults($.datepicker.regional['fr']);

    $('#louvre_bookingbundle_buyer_date').datepicker({
        autosize: true,
        hideIfNoPrevNext: true,
        duration: 'slow',
        firstDay: 0,
        minDate: '-0d',
        maxDate: '+1y',
        beforeShowDay: function(d) {
            var publicHoliday = ['05-01', '11-01', '12-25'];

            if (d.getDay() === 1 || d.getDay() === 6)
            {
                return [false, ''];
            }
            else
            {
                var date = $.datepicker.formatDate('mm-dd', d);

                return [publicHoliday.indexOf(date) === -1]
            }
        }
    });

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
            if (nbVisitors > 0 && nbVisitors < 10)
            {
                $('#step4').fadeIn('slow');
                
                addVisitorForm(nbVisitors, count, container);
            }
            else
            {
                alert('Vous devez sasir un nombre de visiteurs entre 0 et 10 !');
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