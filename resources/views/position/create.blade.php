<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Positions Form') }}
        </h2>
    </header>

    <form method="post" action="{{ route('position.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="positionname" :value="__('Position Name')" />
            <x-text-input id="positionname" name="name" placeholder="Please write your position here " type="text" class="mt-1 block w-full sm:w-1/2" required autofocus autocomplete="positionname" />
            <x-primary-button type=submit class="my-3">{{ __('Create') }}</x-primary-button>
            <x-input-error class="mt-2" :messages="$errors->get('positionname')" />
        </div>
    </form>
    @if (session('status'))
    <div>{{ session('status') }}</div>
@endif
</section>

