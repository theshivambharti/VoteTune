@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            App.toast.success('Success', '{{ session('success') }}');
        });
    </script>
@endif
@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            App.toast.error('Error', '{{ session('error') }}');
        });
    </script>
@endif