@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Candidate Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}. Here are the jobs you've applied to:</p>

    <ul>
        @foreach ($applications as $application)
            <li>
                Job: {{ $application->job->title }} | Status: {{ $application->status }}
                <form action="{{ route('candidate.job-applications.cancel', $application->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Cancel Application</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
