<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Listings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Available Jobs</h1>
                    <ul class="space-y-4">
                        @foreach ($jobs as $job)
                            <li class="border-b pb-2">
                                <a href="{{ route('job-listings.show', $job->id) }}" class="text-blue-600 hover:underline font-semibold">{{ $job->title }}</a>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>Location: {{ $job->location }}</span> |
                                    <span>Category: {{ $job->category }}</span> |
                                    <span>Type: {{ $job->type }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
