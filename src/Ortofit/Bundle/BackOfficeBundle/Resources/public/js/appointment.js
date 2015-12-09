/**
 * Created by rodion on 22.11.15.
 */
$(document).ready(function() {
    jQuery.base = {
        appFormUrl:   null,
        appCreateUrl: null,

        send: function(url, data, callback) {
            $.ajax({
                type: "POST",
                url : url,
                data: data,
                success: function(msg){
                    callback(msg);
                },
                error: function() {
                    callback();
                }
            });
        }
    };
    //http://stackoverflow.com/questions/25266604/create-dynamic-events-to-javascript-calendar
    jQuery.appointment = {
        getData: function() {
            return {
                msisdn:            $('#msisdn').val().replace(/[^0-9]/gim,''),
                clientName:        $('#clientName').val(),
                clientDirectionId: $('#directionId').val(),
                officeId:          $('#officeId').val(),
                dateTime:          $('#date').val().replace(/\//gim, '-')+' '+$('#time').val(),
                duration:          $('#duration').val(),
                description:       $('#description').val()

            };
        },
        processResponse: function(response) {

        },
        create: function() {
            jQuery.base.send(jQuery.base.appCreateUrl, this.getData(), function(){
                $('#appointmentModal').modal('hide');
            });
        },
        loadAppEvents: function(calendarId, officeId, url) {
            jQuery.base.send(url,{office_id:officeId}, jQuery.appointment.calendarFull)
        }
        //http://fullcalendar.io/
        //http://fullcalendar.io/docs/event_data/events_json_feed/
        //calendarFull: function(data) {
        //    $('#calendar').fullCalendar('removeEvents');
        //    console.log(data);
        //    for (var i = 0; i < data.length; i++) {
        //        var event = {
        //            title:           data[i].title,
        //            start:           new Date(data[i].start),
        //            end:             new Date(data[i].end),
        //            allDay:          false,
        //            backgroundColor: data[i].backgroundColor,
        //            borderColor:     data[i].borderColor,
        //        };
        //        $('#calendar').fullCalendar('renderEvent', event, true);
        //    }
        //    $('#calendar').fullCalendar('refetchEvents');
        //}
    };



    $(document).ready(function() {
        $('#appointmentModal').on('show.bs.modal', function (e) {
            jQuery.base.send(jQuery.base.appFormUrl, {}, function(response){
                $('#appointmentModal').empty();
                $('#appointmentModal').append(response);
                $("#date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                $("#time").inputmask("hh:mm", {"placeholder": "hh:mm"});
                $("[data-mask]").inputmask();
                $('#saveButton').click(function(){
                    jQuery.appointment.create();
                });
            })
        })
    });
});