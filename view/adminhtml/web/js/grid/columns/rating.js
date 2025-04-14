define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Shopreviews_Connect/grid/cells/rating'
        },

        /**
         * Ment to preprocess data associated with a current columns' field.
         *
         * @param {Object} row - Data to be preprocessed.
         * @returns {String}
         */
        getRating: function (row) {
            return (+row['rating']/ 5 * 100) + 'px'; 
        }
    });
});
