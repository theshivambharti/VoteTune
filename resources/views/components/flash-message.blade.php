@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof App !== 'undefined' && App.toast) {
                App.toast.success('Success', @json(session('success')));
            } else {
                console.log('Success: ', @json(session('success')));
            }
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof App !== 'undefined' && App.toast) {
                App.toast.error('Error', @json(session('error')));
            } else {
                console.error('Error: ', @json(session('error')));
            }
        });
    </script>
@endif

@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof App !== 'undefined' && App.toast) {
                App.toast.error('Validation Error', 'Please check the form for errors.');
            }
        });
    </script>
@endif