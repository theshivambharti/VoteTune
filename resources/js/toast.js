window.App = window.App || {};

App.toast = {
    show: function(title, text, icon) {
        if(window.Swal) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }
    },
    success: function(title, text) { this.show(title, text, 'success'); },
    error: function(title, text) { this.show(title, text, 'error'); },
    warning: function(title, text) { this.show(title, text, 'warning'); },
    info: function(title, text) { this.show(title, text, 'info'); }
};
