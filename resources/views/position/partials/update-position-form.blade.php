<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Positions Edit Form') }}
        </h2>
    </header>

    <form method="post" action="{{ route('position.update', $position->uuid) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-text-input id="positionname" name="name" class="mt-1 block w-full sm:w-1/2" value="{{ old('name', $position->name) }}" ... />
            <x-primary-button type=submit class="my-3">{{ __('Update') }}</x-primary-button>
            <x-input-error class="mt-2" :messages="$errors->get('positionname')" />
        </div>
    </form>
    @if (session('status'))
    <div>{{ session('status') }}</div>
@endif
</section>

