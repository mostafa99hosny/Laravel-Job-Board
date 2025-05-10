<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">{{ $job->title }}</h1>

                    <div class="mb-6">
                        <p class="mb-4">{{ $job->description }}</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <p><strong>Location:</strong> {{ $job->location }}</p>
                                <p><strong>Job Type:</strong> {{ ucfirst($job->type) }}</p>
                                <p><strong>Category:</strong> {{ $job->category }}</p>
                            </div>
                            <div>
                                <p><strong>Salary:</strong>
                                    @if($job->salary_min && $job->salary_max)
                                        ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                    @elseif($job->salary_min)
                                        From ${{ number_format($job->salary_min) }}
                                    @elseif($job->salary_max)
                                        Up to ${{ number_format($job->salary_max) }}
                                    @else
                                        Not specified
                                    @endif
                                </p>
                                <p><strong>Application Deadline:</strong> {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</p>
                                <p><strong>Posted by:</strong> {{ $job->employer->name }}</p>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user() && auth()->user()->role === 'candidate')
                        <div class="mt-6">
                            <form action="{{ route('job-listings.apply', $job->id) }}" method="POST">
                                @csrf
                                <x-primary-button>
                                    {{ __('Apply for this Job') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

