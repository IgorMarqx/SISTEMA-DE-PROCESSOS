
<script type="text/javascript">
    const warning = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (warning) => {
            warning.addEventListener('mouseenter', Swal.stopTimer)
            warning.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    warning.fire({
        icon: 'warning',
        title: '{{ session('warning') }}'
    })
</script>
