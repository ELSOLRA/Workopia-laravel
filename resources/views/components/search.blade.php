<form method="GET" action="{{ route('jobs.search') }}" class="mx-5 block space-y-2 md:mx-auto md:space-x-2">
    <input type="text" name="keywords" placeholder="Keywords" class="w-full px-4 py-3 focus:outline-none md:w-72"
        value="{{ request('keywords') }}" />
    <input type="text" name="location" placeholder="Location" class="w-full px-4 py-3 focus:outline-none md:w-72"
        value="{{ request('location') }}" />
    <button class="w-full bg-blue-700 px-4 py-3 text-white hover:bg-blue-600 focus:outline-none md:w-auto">
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>
