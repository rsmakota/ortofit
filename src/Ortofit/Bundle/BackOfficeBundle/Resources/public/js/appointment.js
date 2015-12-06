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
        }
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