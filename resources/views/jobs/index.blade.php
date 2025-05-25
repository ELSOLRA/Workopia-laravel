<x-layout>

    <div class="mb-4 flex h-24 items-center justify-center rounded bg-blue-900 px-4">
        <x-search />
    </div>


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
