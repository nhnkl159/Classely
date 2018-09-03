/*
 *  Document   : be_comp_calendar.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Calendar Page
 */

var BeCompCalendar = function() {
    // Add new event in the event list
    var addEvent = function() {
        var eventInput      = jQuery('.js-add-event');
        var eventInputVal   = '';

        // When the add event form is submitted
        jQuery('.js-form-add-event').on('submit', function(){
            eventInputVal = eventInput.prop('value'); // Get input value

            // Check if the user entered something
            if ( eventInputVal ) {
                // Add it to the events list
                jQuery('.js-events')
                    .prepend('<li>' +
                            jQuery('<div />').text(eventInputVal).html() +
                            '</li>');

                // Clear input field
                eventInput.prop('value', '');

                // Re-Init Events
                initEvents();
            }

            return false;
        });
    };

    // Init drag and drop event functionality
    var initEvents = function() {
        jQuery('.js-events')
            .find('li')
            .each(function() {
                var event = jQuery(this);

                // create an Event Object
                var eventObject = {
                    title: jQuery.trim(event.text()),
                    color: event.css('background-color')
                };

                // store the Event Object in the DOM element so we can get to it later
                jQuery(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                jQuery(this).draggable({
                    zIndex: 999,
                    revert: true,
                    revertDuration: 0
                });
            });
    };

    // Init FullCalendar
    var initCalendar = function(){
        var date = new Date();
        var d    = date.getDate();
        var m    = date.getMonth();
        var y    = date.getFullYear();

        jQuery('.js-calendar').fullCalendar({
            editable: false,
            droppable: false,
            locale: 'he',
            header: {
                right: '',
                center: 'title',
                left: ''
            },
            defaultView: 'agendaWeek'
        });
    };

    return {
        init: function () {
            // Add Event functionality
            addEvent();

            // FullCalendar, for more examples you can check out http://fullcalendar.io/
            initEvents();
            initCalendar();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BeCompCalendar.init(); });