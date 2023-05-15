<script type="text/javascript">
    const success = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (success) => {
            success.addEventListener('mouseenter', Swal.stopTimer)
            success.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    success.fire({
        icon: 'success',
        title: '{{ session('success') }}'
    })
</script>

