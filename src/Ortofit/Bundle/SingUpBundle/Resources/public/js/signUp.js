$(document).ready(function() {
    var form    = $('#singForm');
    var btn     = $('#singUpSubmit');
    var errTxt  = $('#errText');
    var iMsisdn = $('#msisdn');
    var fmGroup = $('#formGroup');
    var pattern = '[3-9]{1}[0-9]{8}';
    function setErr() {
       // errTxt.
    }
    form.submit(function() {
       alert(iMsisdn.val().match(pattern));
        return false;
    });



});