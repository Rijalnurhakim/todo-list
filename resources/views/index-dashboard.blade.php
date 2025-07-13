    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 mt-4">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">#</th>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">Task Name</th>
                                    <th class="px-4 py-2 border-b border-gray-300 text-left">Checklist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b border-gray-200">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->todo }}</td>
                                        <td class="px-4 py-2 border-b border-gray-200">
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                                    Checklist
                                                </button>
                                            {{-- <form action="{{ route('tasks.check', $task->uuid ?? $task->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                                    Checklist
                                                </button>
                                            </form> --}}
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

