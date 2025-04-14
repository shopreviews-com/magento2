define([
    'Magento_Ui/js/grid/columns/column',
    'underscore'
], function (Column, _) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Shopreviews_Connect/grid/cells/logo',
            fieldClass: {
                'data-grid-logo-cell': true
            }
        },

        /**
         * Get image source data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getSrc: function (row) {
            return row[this.index + '_src'];
        },

        /**
         * Get alternative text data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getAlt: function (row) {
            return _.escape(row[this.index + '_alt']);
        },
    });
});
