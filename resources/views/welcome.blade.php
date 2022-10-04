<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Job Vacancy </title>


</head>

<body class="antialiased">
<div class="flex justify-center items-center h-screen">
    <h1 class="text-3xl text-purple-600 font-bold">Job Vacancy </h1>
</div>
<div id="app"></div>
@vite('resources/js/app.js')
</body>

</html>
