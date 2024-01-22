<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
            <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
            <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>

            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/select2.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/bootstrap-datetimepicker.min.css">
            <link rel="stylesheet" type="text/css" href="../../../css/styleAdmin.css">
        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <div class="page-wrapper">
            <div class="content">

                {{ $slot }}
            </div>
            </div>

    </body>

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
