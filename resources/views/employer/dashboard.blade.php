<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">My Job Listings</h3>
                        <a href="{{ route('job-listings.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Post a New Job
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="mt-4">
                        @if($jobs->count() > 0)
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($jobs as $job)
                                    <li class="py-4">
                                        <div class="flex justify-between">
                                            <div>
                                                <h4 class="text-lg font-medium">{{ $job->title }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Status: <span class="{{ $job->is_approved ? 'text-green-600' : 'text-yellow-600' }}">
                                                        {{ $job->is_approved ? 'Approved' : 'Pending Approval' }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('job-listings.edit', $job->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                    Edit
                                                </a>
                                                <a href="{{ route('employer.job-applications.view', $job->id) }}" class="inline-flex items-center px-3 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                                    Applications
                                                </a>
                                                <form action="{{ route('job-listings.destroy', $job->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this job?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">You haven't posted any jobs yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
