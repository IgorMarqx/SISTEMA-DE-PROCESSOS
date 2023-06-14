@if (
    $errors->has('lawyer') ||
        $errors->has('emailLawyer') ||
        $errors->has('OAB') ||
        $errors->has('CPF') ||
        $errors->has('password_lawyer'))
    <script>
        $(document).ready(function() {
            $('#lawyerModal').modal('show');
        });
    </script>
@endif
