$(function(){
    
    $('.anchor').click(function(e) {
        if (this.hash !== "")
        {
            var hash = this.hash;
            $('html, body').animate({scrollTop: $(hash).offset().top}, 800, function(){
            window.location.hash = hash;
            });
            e.preventDefault();
        }
    });

	$('#step4, #step5, #stepError1, #stepError2, #formError').hide();

    var container = $('div#louvre_bookingbundle_buyer_bookings');

    // DATEPICKER

    var fullDays = [];
    for (var i = 0; i < daysOff.length; i++) {
        fullDays.push(new Date(daysOff[i].date.date));
    }

    var disabledDays = ['5-1', '11-1', '12-25'];
    for (var i = 0; i < fullDays.length; i++) {
        var month = fullDays[i].getMonth() + 1;
        var day = fullDays[i].getDate()
        var dateString = month + '-' + day;
        dateString.toString();
        disabledDays.push(dateString);
    }

    $.datepicker.regional['fr'] = {
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Févr', 'Mar', 'Avr', 'Mai', 'Jun', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        dateFormat: 'dd/mm/yy'
    };

    $.datepicker.setDefaults($.datepicker.regional['fr']);

    $('#louvre_bookingbundle_buyer_date').datepicker({
        autosize: true,
        hideIfNoPrevNext: true,
        duration: 'slow',
        firstDay: 1,
        minDate: '-0d',
        maxDate: '+1y',
        beforeShowDay: function(d) {
            if (d.getDay() === 0 || d.getDay() === 2)
            {
                return [false, ''];
            }
            else
            {
                var date = $.datepicker.formatDate('m-d', d);

                return [disabledDays.indexOf(date) === -1]
            }
        }
    });

    // HANDLE TYPE TICKET

    $('#louvre_bookingbundle_buyer_typeTicket').focus(function() {
        var dateVisit = getDayPick();
        checkTypeTicket(dateVisit);
    });

    $('form').submit(function(e) {
        var typeTicket = $('#louvre_bookingbundle_buyer_typeTicket option:selected').attr('value');
        var dateVisit = getDayPick();
        var wrongTypeTicket = checkTypeTicket(dateVisit);
        if (typeTicket === 'BJ' && wrongTypeTicket == true)
        {
            $('#formError').fadeIn('fast').delay(5000).hide('slow');
            e.preventDefault();
        }
    });

    // HANDLE VISITORS FORM

    $('#visitorForm').click(function() {
        var count = container.children('div').length;
        var nbVisitors = $('#louvre_bookingbundle_buyer_quantity').val();

        if (count > 0)
        {
            if (nbVisitors > count)
            {
                $('#step4').fadeIn('slow');
                addVisitorForm(nbVisitors, count, container);
            }
            else
            {
                $('#step4').fadeIn('slow');
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
                $('#stepError1').fadeIn('fast').delay(5000).hide('slow');
            }
        }
    });

    $('#emailForm').click(function() {
        var count = container.children('div').length;
        var nbVisitors = $('#louvre_bookingbundle_buyer_quantity').val();
        if (nbVisitors == count)
        {
            $('#step5').fadeIn('slow');
        }    
        else
        {
            $('#stepError2').fadeIn('fast').delay(5000).hide('slow');
        }   
    });

    // FUNCTIONS

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

    function getDayPick()
    {
        var datePick = $('#louvre_bookingbundle_buyer_date').datepicker('getDate');
        var day = datePick.getDate();
        var month = datePick.getMonth();
        var dateVisit = day + '/' + month;
        return dateVisit;
    }

    function checkTypeTicket(dateVisit)
    {
        var date = new Date();
        var hour = date.getHours();
        var day = date.getDate();
        var month = date.getMonth();
        var today = day + '/' + month;

        if (dateVisit === today && hour >= 14)
        {
            $('#louvre_bookingbundle_buyer_typeTicket option:first').attr('disabled', 'disabled').css('background-color', '#babdc1');
            $('#louvre_bookingbundle_buyer_typeTicket option:last').attr('selected', 'true');
            return true;
        }
        else
        {
            $('#louvre_bookingbundle_buyer_typeTicket option:first').removeAttr('disabled').css('background-color', 'white');
            return false;
        }
    }
});