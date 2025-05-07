@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ auth()->user()->name }}'s Profile</h1>
    <form action="{{ route('candidate.profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $candidate->name }}">

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $candidate->email }}">

        <label for="skills">Skills:</label>
        <textarea name="skills">{{ $candidate->skills }}</textarea>

        <label for="experience">Experience:</label>
        <textarea name="experience">{{ $candidate->experience }}</textarea>

        <label for="bio">Bio:</label>
        <textarea name="bio">{{ $candidate->bio }}</textarea>

        <button type="submit">Update Profile</button>
    </form>
</div>
@endsection
