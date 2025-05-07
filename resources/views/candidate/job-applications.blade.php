@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Job Applications</h1>
    <ul>
        @foreach ($applications as $application)
            <li>
                Job: {{ $application->job->title }} | Status: {{ $application->status }}
                <a href="{{ route('job-listings.show', $application->job->id) }}">View Job</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
