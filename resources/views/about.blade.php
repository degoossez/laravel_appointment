<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>About</title>
    @include('layouts.header')
</head>
<body>
    <!-- Included the navbar -->
    @include('layouts.navbar')
    <ul>
        <li>This page is the about page</li>
        <li>I want to have some data from the database below.</li>
        <li>it is not from the database</li>
      </ul>
</body>
