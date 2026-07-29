window.App = window.App || {};

App.ajax = {
    request: function(type, url, data, options = {}) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: type,
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    if(options.showLoader !== false) {
                        // show global loader logic
                    }
                },
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr) {
                    if (xhr.status === 419 || xhr.status === 401) {
                        App.toast.error('Session expired', 'Please reload the page.');
                    } else if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = Object.values(errors).flat().join('<br>');
                        App.toast.error('Validation Error', errorMsg);
                    } else {
                        App.toast.error('Error', 'Something went wrong.');
                    }
                    reject(xhr);
                },
                complete: function() {
                    if(options.showLoader !== false) {
                        // hide global loader logic
                    }
                }
            });
        });
    },
    get: function(url, data = {}, options = {}) { return this.request('GET', url, data, options); },
    post: function(url, data = {}, options = {}) { return this.request('POST', url, data, options); },
    put: function(url, data = {}, options = {}) { return this.request('PUT', url, data, options); },
    delete: function(url, data = {}, options = {}) { return this.request('DELETE', url, data, options); }
};
