/**
 * Created by rodion on 22.11.15.
 */
$(document).ready(function() {
    jQuery.base = {
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
                msisdn:      $('#msisdn').val().replace(/[^0-9]/gim,''),
                name:        $('#clientName').val(),
                directionId: $('#directionId').val(),
                officeId:    $('#officeId').val(),
                date:        $('#date').val().replace(/\//gim, '-')+' '+$('#time').val(),
                duration:    $('#duration').val(),
                description: $('#description').val()

            };
        },
        processResponse: function(response) {

        },
        create: function(url) {
            console.log(this.getData());
            //jQuery.base.send(url, this.getData, this.processResponse);
        }
    };

    $('#saveButton').click(function(){
        jQuery.appointment.create('url');
    });
});