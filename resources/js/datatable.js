window.App = window.App || {};

App.datatable = {
    defaultConfig: {
        responsive: true,
        processing: true,
        serverSide: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        },
        dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
    },
    init: function(selector, config = {}) {
        if(window.$ && $.fn.DataTable) {
            return $(selector).DataTable($.extend(true, {}, this.defaultConfig, config));
        }
    }
};
