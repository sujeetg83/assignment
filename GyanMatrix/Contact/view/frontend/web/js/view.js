define(['uiComponent', 'jquery', 'ko'], function (Component, $, ko) {
    return Component.extend({
        defaults: {
            template: 'GyanMatrix_Contact/form'
        },
        name: ko.observable(''),
        email: ko.observable(''),
        telephone: ko.observable(''),
        comment: ko.observable(''),

        saveForm: function () {
            let data = {
                name: this.name(),
                email: this.email(),
                telephone: this.telephone(),
                comment: this.comment(),
            };

            $.ajax({
                url: '/newcontact/index/save',
                type: 'POST',
                data: data,
                success: function (response) {
                    console.log('Form submitted successfully!');
                },
                error: function () {
                    console.log('An error occurred.');
                }
            });
        }
    });
});