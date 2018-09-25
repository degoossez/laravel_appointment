<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Dashboard</title>
    @include('layouts.header')
</head>
<body>
    <!-- Included the navbar -->
    @include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card top-buffer">
                <div class="card-header">Admin panel</div>
            </div>
        </div>
        This is the admin panel.
    </div>
</div>
</body>
