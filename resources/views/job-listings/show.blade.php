@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    <p>{{ $job->description }}</p>
    <p>Location: {{ $job->location }}</p>
    <p>Salary: {{ $job->salary }}</p>
    <p>Category: {{ $job->category }}</p>
    <p>Status: {{ $job->status }}</p>

    @if(auth()->user() && auth()->user()->role === 'candidate')
        <form action="{{ route('job-listings.apply', $job->id) }}" method="POST">
            @csrf
            <button type="submit">Apply</button>
        </form>
    @endif
</div>
@endsection

