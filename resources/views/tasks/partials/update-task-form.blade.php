<section>
    <form method="post" action="{{ route('tasks.update', $task->uuid) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-text-input id="positionname" name="todo" class="mt-1 block w-full sm:w-1/2" value="{{ old('name', $task->todo) }}" ... />
            <x-primary-button type=submit class="my-3">{{ __('Update') }}</x-primary-button>
            <x-input-error class="mt-2" :messages="$errors->get('todo')" />
        </div>
    </form>
    @if (session('status'))
    <div>{{ session('status') }}</div>
    @endif
</section>
