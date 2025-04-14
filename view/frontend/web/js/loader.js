define([
    'rjsResolver',
], function (resolver) {
    'use strict';

    /**
     * Removes provided loader element from DOM.
     *
     * @param {HTMLElement} $loader - Loader DOM element.
     */
    function hideLoader($loader) {
        let defaultValue = this;
        $loader.parentNode.removeChild($loader);
    }

    /**
     * Initializes assets loading process listener.
     *
     * @param {Object} config - Optional configuration default data after loaded component
     * @param {HTMLElement} $loader - Loader DOM element.
     */
    function init(config, $loader) {
        resolver(hideLoader.bind(config, $loader));
    }

    return init;
});