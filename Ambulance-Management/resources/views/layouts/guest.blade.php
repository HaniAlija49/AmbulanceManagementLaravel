<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ambulance') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/select2.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/bootstrap-datetimepicker.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/styleAdmin.css">


    </head>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-6 pt-sm-0 bg-light dark-bg-dark">
        <div class="w-25 max-w-md mt-6 p-4 bg-white dark-bg-dark shadow-sm rounded-lg">
            {{ $slot }}
        </div>
    </div>
    <script src="../../../lib/jquery/dist/jquery.min.js"></script>
    <script src="../../../lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/site.js" asp-append-version="true"></script>
    <script src="../../../js/jquery-3.2.1.min.js"></script>
    <script src="../../../js/popper.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/jquery.slimscroll.js"></script>
    <script src="../../../js/select2.min.js"></script>
    <script src="../../../js/jquery.dataTables.min.js"></script>
    <script src="../../../js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../js/moment.min.js"></script>
    <script src="../../../js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../../js/app.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
</html>
