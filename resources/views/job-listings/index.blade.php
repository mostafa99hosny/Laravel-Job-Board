@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Job Listings</h1>
    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="{{ route('job-listings.show', $job->id) }}">{{ $job->title }}</a>
                | Location: {{ $job->location }}
                | Category: {{ $job->category }}
                | Salary: {{ $job->salary }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
