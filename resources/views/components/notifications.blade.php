@props(['notification' => null])

@if ($notification)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '{{ $notification['type'] }}',
                title: {!! json_encode($notification['message']) !!},
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            });
        });
    </script>
@endif
