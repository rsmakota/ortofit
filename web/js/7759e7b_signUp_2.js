$(document).ready(function() {
    jQuery.singObj = {
        form        : $('#singForm'),
        btn         : $('#singUpSubmit'),
        errTxt      : $('#errText'),
        process     : $('#processBlock'),
        iMsisdn     : $('#msisdn'),
        fmGroup     : $('#formGroup'),
        successText : $('#successText'),
        pattern     : null,
        url         : null,
        token       : null,
        appId       : null,
        init: function (url, pattern, prefix, token, appId) {
            var me       = this;
            this.url     = url;
            this.token   = token;
            this.prefix  = prefix;
            this.pattern = pattern;
            this.appId   = appId;

            this.btn.prop('disabled', false);
            this.iMsisdn.prop('disabled', false);
            this.iMsisdn.keyup(function() {
                me.hideErrs();
                if (me.isMsisdnValid()) {
                    me.showSuccessMsisdn();
                } else {
                    me.hideSuccessMsisdn();
                }
            });

            this.form.submit(function() {
                if (me.isMsisdnValid()) {
                    me.showProcess();
                    me.pushMsisdn();
                    me.disableForm();
                } else {
                    me.showErrs();
                }

                return false;
            });
        },

        showErrs: function () {
            this.errTxt.removeClass('hidden');
            this.fmGroup.addClass('has-error');
        },

        hideErrs: function () {
            this.errTxt.addClass('hidden');
            this.fmGroup.removeClass('has-error');
        },

        showSuccessMsisdn: function () {
            this.fmGroup.addClass('has-success');

        },

        hideSuccessMsisdn: function () {
            this.fmGroup.removeClass('has-success');
        },

        showSuccessProcess: function () {
            this.successText.removeClass('hidden');
        },

        showProcess: function () {
            this.process.removeClass('hidden');
        },

        hideProcess: function () {
            this.process.addClass('hidden');
        },

        isMsisdnValid: function () {
            if(null != this.getMsisdn().match(this.pattern)) {
                return true;
            }

            return false;
        },

        getMsisdn: function() {
            return this.prefix + this.iMsisdn.val();
        },

        disableForm: function () {
            this.btn.prop('disabled', true);
            this.iMsisdn.prop('disabled', true);
        },

        pushDataFormat: function() {
            var me = this;
            return {
                msisdn             : me.getMsisdn(),
                sing_up_token_name : me.token,
                application_id     : me.appId
            }
        },

        pushMsisdn: function() {
            var me = this;
            $.ajax({
                type: "POST",
                url : me.url,
                data: me.pushDataFormat(),
                success: function(msg){
                    me.hideProcess();
                    if ('success' == msg) {
                        me.showSuccessProcess();
                    } else {
                        me.showErrs();
                        me.btn.prop('disabled', false);
                    }
                },
                error: function() {
                    me.showErrs();
                    me.btn.prop('disabled', false);
                }
            });
        }
    };
});