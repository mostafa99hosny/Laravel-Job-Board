@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employer Dashboard</h1>
    <a href="{{ route('job-listings.create') }}">Post a new job</a>

    <h3>My Jobs</h3>
    <ul>
        @foreach ($jobs as $job)
            <li>
                {{ $job->title }} - Status: {{ $job->status }}
                <a href="{{ route('job-listings.edit', $job->id) }}">Edit</a>
                <form action="{{ route('job-listings.destroy', $job->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                <a href="{{ route('employer.job-applications.view', $job->id) }}">View Applications</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
