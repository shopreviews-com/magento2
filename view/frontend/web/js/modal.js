define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function($, modal) {
    var options = {
        type: 'popup',
        responsive: true,
        innerScroll: true,
        title: $.mage.__('Filter Reviews'),
        modalClass: 'shopreviews_com_modal-filters_container',
        buttons: []
    };

    modal(options, $('#modal-filters'));
});
