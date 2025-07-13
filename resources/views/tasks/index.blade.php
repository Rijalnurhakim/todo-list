<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>
{{-- @dd($tasks) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    @include('tasks.create')
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    {{ __("Task List") }}
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 mt-4">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">#</th>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">Task Name</th>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">User</th>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b border-gray-200">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->todo }}</td>
                                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->user->name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-200">
                                            <div class="flex gap-2">
                                                <a href="{{ route('tasks.edit', $task->uuid ?? $task->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task->uuid ?? $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-center">Tidak ada task</td>
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
