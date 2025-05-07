@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Applications for Job: {{ $job->title }}</h1>
    
    <h3>Applicants</h3>
    <ul>
        @foreach ($job->applications as $application)
            <li>
                Candidate: {{ $application->candidate->name }} | Status: {{ $application->status }}
                <form action="{{ route('candidate.job-applications.cancel', $application->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Reject Application</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection

