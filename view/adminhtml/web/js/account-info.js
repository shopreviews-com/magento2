define(['jquery', 'mage/loader'], function($) {
    'use strict';

    return function(_, element) {
        const ShopreviewsAccountInfo = {
            processUrl: null,
            buttons: {
                connect: element.querySelector('#shopreviews-button-connect'),
                disconnect: element.querySelector('#shopreviews-button-disconnect'),
                sync: element.querySelector('#shopreviews-sync-reviews'),
                websites: element.querySelector('#shopreviews-show-websites'),
                sources: element.querySelector('#shopreviews-show-sources'),
            },

            modals: {
                connect: element.querySelector('#shopreviews-modal-connect'),
                websites: element.querySelector('#shopreviews-modal-account'),
                sources: element.querySelector('#shopreviews-modal-sources'),
                overlay: element.querySelector('.shopreviews-modal-overlay'),
            },

            init() {
                this.isReviewsSync();

                // We only wire up the click handlers here, and NOT setIframeUrl yet
                ['connect', 'websites', 'sources'].forEach((key) => {
                    if (this.buttons[key]) {
                        this.buttons[key].addEventListener('click', () => {
                            // Set the iframe URL right before showing the modal
                            this.setIframeUrl(this.buttons[key], this.modals[key]);
                            this.showModal(this.modals[key]);
                        });
                    }
                });

                // Disconnect button
                if (this.buttons.disconnect) {
                    this.buttons.disconnect.addEventListener('click', () => this.getDisconnect());
                }

                // Sync button
                this.buttons.sync.addEventListener('click', () => $('body').loader('show'));

                // Overlay click closes modals
                this.modals.overlay.addEventListener('click', () => this.closeModals());

                // postMessage listener
                window.addEventListener('message', (event) => {
                    if (event.origin !== 'https://app.shopreviews.com' || !event.data) {
                        return;
                    }

                    if (event.data.status === 'submit-login' || event.data.status === 'submit-register') {
                        if (this.processUrl) {
                            window.location.replace(this.processUrl);
                        }
                    }
                });
            },

            async getDisconnect() {
                $('body').loader('show');

                try {
                    const URL = this.buttons.disconnect.getAttribute('data-url');
                    await fetch(URL);
                    window.location.reload();
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    $('body').loader('hide');
                }
            },

            /**
             * Sets the iframe URL by calling the endpoint in data-url
             * and then updates the src of the iframe within the associated modal.
             */
            async setIframeUrl(button, modal) {
                const URL = button.getAttribute('data-url');

                try {
                    const response = await fetch(URL);
                    const data = await response.json();
                    if (modal) {
                        this.processUrl = data.process_url;
                        modal.querySelector('iframe').src = data.url;
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            },

            /**
             * Disables certain buttons if the reviews sync date is invalid.
             */
            isReviewsSync() {
                const syncData = element.querySelector('[data-element=\"value\"].shopreviews-sync-reviews').innerText;

                if (isNaN(Date.parse(syncData))) {
                    ['websites', 'sources'].forEach((key) => {
                        if (this.buttons[key]) {
                            this.buttons[key].classList.add('disabled');
                        }
                    });
                }
            },

            showModal(modal) {
                if (modal) {
                    modal.classList.add('show');
                }
            },

            closeModals() {
                Object.values(this.modals).forEach((modal) => {
                    if (modal && modal.classList.contains('show')) {
                        modal.classList.remove('show');
                    }
                });
            },
        };

        ShopreviewsAccountInfo.init();
    };
});