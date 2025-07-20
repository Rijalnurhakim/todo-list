<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Position') }}
        </h2>
    </x-slot>
{{-- @dd($positions[0]->name) --}}
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    @include('position.create')
                </div>
            </div>
            <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    <h3>Position List</h3>
                    <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 bg-white">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">No.</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position Name</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($positions as $position)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowarp text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowarp text-sm text-gray-700">{{ $position->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowarp text-sm text-gray-700 text-center">
                                            <div class="flex justify-center item-center space-x-2">
                                                <a href="{{ route('position.edit', $position->uuid) }}" class="inline-flex items-center justify-center px-4 py-2 bg-biru text-white rounded font-semibold rounded-md shadow-sm hover:bg-blue-900 focus:outline-none focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 text-sm text-sm">Edit</a>
                                                <form action="{{ route('position.destroy', $position->uuid) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-sm hover:text-gray-200 hover:bg-oren focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset2 transition ease-in-out duration-150 text-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No positions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
