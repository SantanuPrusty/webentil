define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($) {
        "use strict";
        //creating jquery widget
        $.widget('Vendor.modalForm', {
            options: {
                modalForm: '#modal-form',
                modalButton: '.open-modal-form'
            },
            _create: function() {
                this.options.modalOption = this._getModalOptions();
                this._bind();
            },
            _getModalOptions: function() {
                /**
                 * Modal options
                 */
                var options = {
                    type: 'popup',
                    responsive: true,
                    title: 'Add New Testimonial',
                };

                return options;
            },
            _bind: function(){
                var modalOption = this.options.modalOption;
                var modalForm = this.options.modalForm;

                $(document).on('click', this.options.modalButton,  function(){
                    //Initialize modal
                    $(modalForm).modal(modalOption);
                    //open modal
                    $(modalForm).trigger('openModal');
                });
            }
        });

        return $.Vendor.modalForm;
    }
);
