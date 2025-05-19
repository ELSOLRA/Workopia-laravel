<x-layout>



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
