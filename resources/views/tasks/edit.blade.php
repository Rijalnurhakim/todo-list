<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Edit Tasks') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    <!-- Kirim variabel $userposition ke partial view -->
                    @include('tasks.partials.update-task-form', [
                        'task' => $task,
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
