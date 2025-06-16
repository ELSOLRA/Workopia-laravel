<x-layout>
    <section class="flex flex-col gap-4 md:flex-row">
        {{-- Profile info form --}}
        <div class="w-full rounded-lg bg-white p-8 shadow-md">
            <h3 class="mb-4 text-center text-3xl font-bold">
                Profile info
            </h3>

            @if ($user->avatar)
                <div class="mt-2 flex justify-center">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                        class="h-26 w-26 rounded-full object-cover">
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-inputs.text id="name" name="name" label="Name" value="{{ $user->name }}" />
                <x-inputs.text id="email" name="email" label="Email" type="email"
                    value="{{ $user->email }}" />

                <x-inputs.file id="avatar" name="avatar" label="Upload avatar" />

                <button type="submit"
                    class="border-rounded w-full bg-green-500 px-4 py-2 text-white hover:bg-green-600 focus:outline-none">Save</button>
            </form>
        </div>
        {{-- Job listings --}}
        <div class="w-full rounded-lg bg-white p-8 shadow-md">
            <h3 class="mb-4 text-center text-3xl font-bold">
                My Job Listings
            </h3>
            <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 p-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    {{-- System Jobs --}}
                    <div class="flex items-center justify-center">
                        <i class="fas fa-briefcase mr-3 text-xl text-blue-500"></i>
                        <div class="text-center">
                            <p class="text-sm font-semibold text-gray-600">System Jobs</p>
                            <p class="text-2xl font-bold">
                                <span class="{{ \App\Models\Job::count() >= 28 ? 'text-red-500' : 'text-blue-600' }}">
                                    {{ \App\Models\Job::count() }}
                                </span>
                                <span class="text-blue-600"> / 30</span>
                            </p>
                        </div>
                    </div>

                    {{-- Your Jobs --}}
                    <div class="flex items-center justify-center">
                        <i
                            class="fas fa-user-tie {{ auth()->user()->jobListings()->count() >= 0 ? 'text-red-500' : 'text-green-500' }} mr-3 text-xl"></i>
                        <div class="text-center">
                            <p class="text-sm font-semibold text-gray-600">Your Jobs</p>
                            <p class="text-2xl font-bold">
                                <span
                                    class="{{ auth()->user()->jobListings()->count() >= 8 ? 'text-red-500' : 'text-green-500' }}">
                                    {{ auth()->user()->jobListings()->count() }}
                                </span>
                                <span class="text-green-500"> / 10</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Warning messages --}}
                @if (auth()->user()->jobListings()->count() >= 8 || \App\Models\Job::count() >= 25)
                    <div class="mt-4 space-y-2 text-center">
                        @if (auth()->user()->jobListings()->count() >= 8)
                            <p class="text-sm text-red-600">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Approaching your limit ({{ 10 - auth()->user()->jobListings()->count() }} job slots
                                remaining)
                            </p>
                        @endif

                        @if (\App\Models\Job::count() >= 25)
                            <p class="text-sm text-red-600">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                System approaching limit ({{ 30 - \App\Models\Job::count() }} total job slots
                                remaining)
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            @forelse($jobs as $job)
                <div class="flex items-center justify-between border-b-2 border-gray-200 py-2">
                    <div>
                        <h3 class="fond-semibold text-xl">{{ $job->title }}</h3>
                        <p class="text-gray-700">{{ $job->job_type }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('jobs.edit', $job->id) }}"
                            class="rounded bg-blue-500 px-4 py-2 text-sm text-white">Edit</a>
                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }}?from=dashboard"
                            onsubmit="return confirm('Are you sure to delete this Job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                {{-- Applicants --}}
                <div class="mt-4 rounded-md bg-gray-100 p-2">
                    <h4 class="mb-2 text-lg font-semibold">Applicants</h4>
                    @forelse ($job->applicants as $applicant)
                        <div class="py-2">
                            <p class="text-gray-800">
                                <strong>Name: </strong>{{ $applicant->full_name }}
                            </p>
                            <p class="text-gray-800">
                                <strong>Phone: </strong>{{ $applicant->contact_phone }}
                            </p>
                            <p class="text-gray-800">
                                <strong>Email: </strong>{{ $applicant->contact_email }}
                            </p>
                            <p class="text-gray-800">
                                <strong>Message: </strong>{{ $applicant->message }}
                            </p>
                            <p class="mb-3 mt-2 text-gray-800">
                                <a href="{{ asset('storage/' . $applicant->resume_path) }}"
                                    class="rounded-md bg-gray-300 px-2 py-2 text-sm font-semibold text-blue-500 hover:bg-gray-200 hover:underline"
                                    download>
                                    <i class="fa fa-download"></i> Download Resume
                                </a>
                            </p>
                            {{-- Delete applicant --}}
                            <form action="{{ route('applicant.destroy', $applicant->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this applicant?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-md bg-gray-300 px-2 py-2 text-sm font-semibold text-red-500 hover:bg-gray-200 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Delete Applicant
                                </button>
                            </form>
                        </div>

                    @empty
                        <p class="mb-6 text-gray-700">No applicants for this job</p>
                    @endforelse
                </div>

            @empty
                <p class="text-gray-700">You have no job listings</p>
            @endforelse
        </div>
    </section>
    <x-bottom-banner />
</x-layout>
