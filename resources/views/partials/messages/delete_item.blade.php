<script>
    function destroy(event, id, form = '#form-delete-') {
        event.preventDefault();
        Swal.fire({
            title: "{{ __('messages.confirm_delete') }}",
            showCancelButton: true,
            confirmButtonText: "{{ __('button.confirm') }}",
            cancelButtonText: "{{ __('button.cancel') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                $(form + id).submit();
            }
        });
    }
</script>
