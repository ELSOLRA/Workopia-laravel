<x-layout>

    <div class="mb-10 mt-2 flex h-24 items-center justify-center rounded bg-blue-900 px-4 md:mb-4 md:mt-0">
        <x-search />
    </div>

    {{-- Back button --}}
    @if (request()->has('keywords') || request()->has('location'))
        <a href="{{ route('jobs.index') }}"
            class="mb-4 inline-block rounded bg-gray-700 px-4 py-2 text-white hover:bg-gray-600">
            <i class="fa fa-arrow-left mr-1"></i> Back
        </a>
    @endif

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">

        @forelse($jobs as $job)
            <x-job-card :job="$job" />
        @empty
            <p>No Jobs Available</p>
        @endforelse
    </div>
    {{-- Pagination links --}}
    {{ $jobs->links() }}
</x-layout>
