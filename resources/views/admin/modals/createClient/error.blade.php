@if (
    $errors->has('name') ||
        $errors->has('email') ||
        $errors->has('organ') ||
        $errors->has('office') ||
        $errors->has('capacity') ||
        $errors->has('telephone') ||
        $errors->has('password_confirmation'))
    <script>
        $(document).ready(function() {
            $('#clientModal').modal('show');
        });
    </script>
@endif
