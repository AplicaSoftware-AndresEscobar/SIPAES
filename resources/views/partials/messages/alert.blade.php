@if ($alert = session()->get('alert'))
    <script>
        Swal.fire({
            position: 'center',
            title: "{{ $alert['title'] }}",
            icon: "{{ $alert['icon'] }}",
            html: "{!! $alert['text'] !!}",
            height: 200,
            width: 500,
            timer: 2000,
            timerProgressBar: true,
        });
    </script>
@endif
