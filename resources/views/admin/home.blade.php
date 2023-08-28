@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Admin Panel</h1>
    <p class="fs-3">Welcome, {{ $user->name }}! Your mail is: {{ $user->email }}.</p>
    <p class="fs-5">You can access the Admin Panel sections via the top navigation bar.</p>
</div>
@endsection