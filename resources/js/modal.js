window.App = window.App || {};

App.modal = {
    open: function(modalId) {
        const modalEl = document.getElementById(modalId);
        if(modalEl && window.bootstrap) {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    },
    close: function(modalId) {
        const modalEl = document.getElementById(modalId);
        if(modalEl && window.bootstrap) {
            const modal = bootstrap.Modal.getInstance(modalEl);
            if(modal) modal.hide();
        }
    }
};
