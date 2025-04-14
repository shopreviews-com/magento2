define([
    'ko',
    'jquery',
    'uiComponent',
    'Magento_Ui/js/model/messageList'
], function (ko, $, Component, messageList) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Shopreviews_Connect/reviews',
            filter: {
                source: [],
                sorting: {
                    current: ko.observable(''),
                    next: ko.observable(''),
                }
            }
        },

        reviewsList: {
            filters: ko.observable([]),
            data: ko.observable([]),
            pagination: ko.observable([]),
            summary: ko.observable([])
        },

        /**
         * Initialize.
         */
        initialize: function () {
            this._super();
            this.initReviewsData(this.reviews);
            this.initDefaultFilterState(this.reviews.filters);

            console.log(this);
            return this;
        },

        setFilterSource(value) {
            const index = this.filter.source.indexOf(value);

            index === -1
                ? this.filter.source.push(value)
                : this.filter.source.splice(index, 1);

            this.updateReviews(1);
        },

        setSorting(value) {
            this.filter.sorting.next(this.filter.sorting.current());
            this.filter.sorting.current(value);
            this.updateReviews(1);
        },

        initDefaultFilterState(filters) {
            const sources = filters.source.data;
            const sorting = filters.sorting.data;
            
            this.filter.source = [...sources.filter(item => item.selected === true).map(item => item.value)];
            this.filter.sorting.current(sorting.find(item => item.selected)?.value || null);
            this.filter.sorting.next(sorting.find(item => !item.selected)?.value || null);
        },

        initReviewsData(reviews) {
            if (reviews) {
                this.reviews.pagination = reviews.pagination;
                var self = this;
                for (var prop in reviews) {
                    if (reviews.hasOwnProperty(prop)) {
                        if (prop === 'data') {
                            self.reviewsList[prop](Object.values(reviews[prop]));
                        } else if (prop === 'pagination') {
                            const pagination = reviews[prop];
                            const current = pagination.currentPage; // Current page number (assumed to be 1-based)
                            const length = pagination.pages.length; // Total number of pages

                            const totalPagesToShow = 15; // Always show 10 pages
                            const halfRange = Math.floor(totalPagesToShow / 2); // 5 pages before and after the current page

                            let start = current - halfRange - 1; // Subtract 1 if currentPage is 1-based (convert to 0-based index)
                            let end = current + halfRange - 1;

                            if (start < 0) {
                                end += Math.abs(start);
                                start = 0;
                            }

                            if (end > length) {
                                start -= (end - length);
                                end = length;
                            }

                            start = Math.max(0, start);
                            pagination.pages = reviews[prop].pages.slice(start, end);

                            self.reviewsList[prop](pagination);
                        } else {
                            self.reviewsList[prop](reviews[prop]);
                        }
                    }
                }
            }
        },

        showFilters: function () {
            $('#modal-filters').modal('openModal');
        },

        updateReviews: function (newPage) {
            var accountFilters = $('input:checkbox[name=accounts]:checked').map(function() { return this.value; }).get();
            var ratingFilters = $('input:checkbox[name=ratings]:checked').map(function() { return this.value; }).get();
            var page = newPage || this.reviewsList.pagination()['currentPage'];

            var params = {
                accounts: accountFilters.join(','),
                sources: this.filter.source.join(','),
                sorting: this.filter.sorting.current(),
                ratings: ratingFilters.join(','),
                page: +page
            };
            var self = this;
            $.ajax({
                showLoader: true,
                url: this.reviewsList.filters().url,
                data: params,
                type: "POST",
                dataType: 'json'
            }).done(function (data) {
                if (data.reviews){
                    self.initReviewsData(data.reviews);
                    self.setLinkParams();
                } else {
                    messageList.addErrorMessage({ message: 'Something went wrong during the data update' });
                }
            });
        },

        changeCheckboxStates: function (id) {
            var elem = $('#'+id);
            var groupName = elem.attr('name');
            if (id.includes('all')) {
                if (elem.is(':checked')) {
                    $('input:checkbox[name='+groupName+']:not(:checked)').attr('checked', true);
                }
            } else {
                $('#'+groupName+'-filter-all').attr('checked', false);
            }

            return true;
        },

        isFiltersVisible: function () {
            var filters = this.reviewsList.filters();
            for (var object in filters) {
                if (filters.hasOwnProperty(object) && filters[object].enabled) {
                    return true;
                }
            }
            return false;
        },

        setLinkParams: function () {
            var pathValues = window.location.pathname.replace(/^\/|\/$/g, '').split('/');
            var pageIndex = pathValues.indexOf('page');
            var filterIndex = pathValues.indexOf('filters');
            var newPath = [];
            pathValues.forEach(function (element, index) {
                if (index != pageIndex && index != filterIndex && (pageIndex == -1 || index != pageIndex+1)
                    && (filterIndex == -1 || index != filterIndex+1)) {
                    newPath.push(element);
                }
            });
            var params = '';
            if (this.reviewsList.pagination().currentPage && this.reviewsList.pagination().currentPage != 1) {
                params += 'page/' + this.reviewsList.pagination().currentPage + '/';
            }
            if (this.reviewsList.filters().filtersHash && this.isFiltersVisible()) {
                params += 'filters/' + this.reviewsList.filters().filtersHash + '/';
            }
            var newStateUrl = window.location.origin + '/' + newPath.join('/') + '/' + params + window.location.hash;
            var pageTitle = this.reviewsList.filters().pageTitle || '';
            window.history.replaceState({}, pageTitle, newStateUrl);
        }
    });
});
