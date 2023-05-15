
<script type="text/javascript">
    const error = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (error) => {
            error.addEventListener('mouseenter', Swal.stopTimer)
            error.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    error.fire({
        icon: 'error',
        title: '{{ session('error') }}'
    })
</script>
