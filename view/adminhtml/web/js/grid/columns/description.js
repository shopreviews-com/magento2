define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Shopreviews_Connect/grid/cells/description',
        },

        /**
         * Initializes column component.
         *
         * @returns {Column} Chainable.
         */
        initialize: function () {
            this._super()
                .initFieldClass();

            
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.description')) this.hideInfo();
            });

            return this;
        },

        /**
         * Ment to preprocess data associated with a current columns' field.
         *
         * @param {Object} row - Data to be preprocessed.
         * @returns {String}
         */
        getDescription(row) {
            return row[this.index];
        },

        getId(row) {
            return row['entity_id'];
        },

        getName(row) {
            return row['name'];
        },

        getRating(row) {
            return (+row['rating']/ 5 * 100) * 1.2 + 'px'; 
        },

        getPlatform(row) {
            return row['platform_name'];
        },

        getDate(row) {
            const options = { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit' 
            };

            return new Date(row['review_date']).toLocaleDateString('en-US', options).replace(',', '');
        },

        showInfo(_, e) {
            this.hideInfo();
            e.currentTarget.closest('div').classList.add('show-info');
        },

        hideInfo() {
            const info = document.querySelector('.description .show-info');
            if (info) info.classList.remove('show-info');
        },
    });
});
