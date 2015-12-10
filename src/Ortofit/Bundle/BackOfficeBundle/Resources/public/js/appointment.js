/**
 * Created by rodion on 22.11.15.
 */
$(document).ready(function() {
    jQuery.base = {
        appFormUrl:   null,
        appCreateUrl: null,
        appUpdateUrl: null,
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
        },
        getModal: function() {
            return $('#appointmentModal');
        }
    };

    jQuery.appointment = {
        getData: function() {
            return {
                msisdn:            $('#msisdn').val().replace(/[^0-9]/gim,''),
                clientName:        $('#clientName').val(),
                clientDirectionId: $('#directionId').val(),
                officeId:          $('#officeId').val(),
                dateTime:          $('#date').val().replace(/\//gim, '-')+' '+$('#time').val(),
                duration:          $('#duration:checked').val(),
                description:       $('#description').val(),
                appId:             $('#appId').val(),
                serviceId:         $('#serviceId').val()

            };
        },
        processResponse: function(response) {

        },
        create: function() {
            jQuery.base.send(jQuery.base.appCreateUrl, this.getData(), function(){
                jQuery.base.getModal().modal('hide');
                var calendar = $('#calendar'+$('#officeId').val());
                calendar.fullCalendar('refetchEvents');
            });
        },
        update: function() {
            jQuery.base.send(jQuery.base.appUpdateUrl, this.getData(), function(){
                jQuery.base.getModal().modal('hide');
                var calendar = $('#calendar'+$('#officeId').val());
                calendar.fullCalendar('refetchEvents');
            });
        },

        init: function(appId) {
            $("#date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            $("#time").inputmask("hh:mm", {"placeholder": "hh:mm"});
            $("[data-mask]").inputmask();

            $('#saveButton').click(function(){
                if (appId) {
                    jQuery.appointment.update();
                } else {
                    jQuery.appointment.create();
                }
            });
        }
    };



    $(document).ready(function() {
        $('#appButton').click(function (e) {
            jQuery.base.send(jQuery.base.appFormUrl, {}, function(response){
                var modal = jQuery.base.getModal();
                modal.empty();
                modal.append(response);
                modal.modal();
            })
        });


    });
});