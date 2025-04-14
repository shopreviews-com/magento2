define([
    'jquery',
    'slick-min'
], function($) {
    return function (config, elem) {
        return $(elem).slick(config);
    };
});
