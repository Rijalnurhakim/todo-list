<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    {{ __("Task List") }}
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 mt-4">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">Task Name</th>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    <tr class="hover:bg-gray-50">
                                        <td x-data="{ editMode: false, newTodo: '{{ $task->todo }}' }" class="px-4 py-2 border-b border-gray-200">

                                            <!-- Mode tampilan -->
                                            <div x-show="!editMode" @click="editMode = true" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">
                                                {{ $task->todo }}
                                            </div>
                                            <!-- Mode edit -->
                                            <form x-show="editMode" x-cloak method="POST" action="{{ route('tasks.update', $task->uuid) }}" @click.away="editMode = false">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="todo" x-model="newTodo" class="border rounded px-2 py-1 w-full" @keydown.enter.prevent="$el.form.submit()">
                                            </form>
                                        </td>
                                        <td class="px-4 py-2 border-b border-gray-200">
                                            <div class="flex gap-2">
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
                                <td x-data="{ createMode: false, newTodo: '' }" class="px-4 py-2 border-b border-gray-200">
                                    <!-- Tombol "Add +" -->
                                    {{-- <button @click="createMode = true"
                                            class="text-blue-600 hover:underline text-sm font-semibold"
                                            x-show="!createMode">
                                        Add +
                                    </button> --}}
                                    <div class="flex items-center gap-4">
                                        <x-primary-button @click="createMode = true" class="text-blue-600 text-sm font-semibold" x-show="!createMode">{{ __('Add Task') }}</x-primary-button>
                                    </div>
                                    <!-- Form Input Task -->
                                    <form method="post" action="{{ route('tasks.store') }}"
                                        x-show="createMode"
                                        @click.outside="createMode = false"
                                        @submit.window="createMode = false"
                                        class="mt-2 space-y-2"
                                        @submit.prevent="$el.submit()">
                                        @csrf
                                        <input
                                            x-model="newTodo"
                                            name="todo"
                                            type="text"
                                            placeholder="Please write your new task here..."
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
                                            required
                                        />
                                        <div class="flex items-center gap-2">
                                            {{-- <button type="submit"
                                                class="bg-indigo-600 text-white px-4 py-1 rounded hover:bg-indigo-700 text-sm">
                                                Save
                                            </button> --}}
                                            <x-primary-button type="button"
                                                @click="createMode = false"
                                                class="text-blue-600 text-sm font-semibold">
                                                Cancel
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </td>
                            </tbody>
                        </table>
                        @if (session('status'))
                            <div>{{ session('status') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
