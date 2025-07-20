<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Task Form') }}
        </h2>
    </header>

    <form method="post" action="{{ route('tasks.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="taskname" :value="__('Task Name')" />
            <x-text-input id="taskname" name="todo" placeholder="Please write your task here......." type="text" class="mt-1 block w-full" required autofocus autocomplete="taskname" />
            <x-input-error class="mt-2" :messages="$errors->get('todo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add +') }}</x-primary-button>

            @if (session('status') === 'task-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Create.') }}</p>
            @endif
        </div>
    </form>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
</section>

