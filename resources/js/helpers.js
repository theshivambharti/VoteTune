window.App = window.App || {};

App.helpers = {
    init: function() {
        console.log('App helpers initialized');
    },
    debounce: function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
};

document.addEventListener('DOMContentLoaded', App.helpers.init);
