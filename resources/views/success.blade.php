@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
    <h1 class="display-1 fw-bold text-success">Success</h1>

    <p class="mt-3 text-muted">Redirecting to Homepage in 5 seconds...</p>
</div>

<script>
    setTimeout(function() {
        window.location.href = '{{ route('home') }}';
    }, 5000);
</script>

@endsection