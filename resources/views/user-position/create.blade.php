<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User Positions Form') }}
        </h2>
    </header>
{{-- @dd($users, $positions) --}}
    <form method="post" action="{{ route('user-position.store') }}" class="mt-6">
        @csrf
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
            <div class="flex-1">
                <x-input-label for="user_id" :value="__('User')" />
                <select id="user_id" name="user_id" class="mt-1 block w-full" required>
                    @forelse($users as $user)
                        <option value="{{ $user->uuid }}">{{ $user->name }}</option>
                    @empty
                        <option disabled>Tidak ada user</option>
                    @endforelse
                </select>
            </div>
            <div class="flex-1">
                <x-input-label for="position_id" :value="__('Position')" />
                <select id="position_id" name="position_id" class="mt-1 block w-full" required>
                    @forelse($positions as $position)
                        <option value="{{ $position->uuid }}">{{ $position->name }}</option>
                    @empty
                        <option disabled>Tidak ada posisi</option>
                    @endforelse
                </select>
            </div>
        </div>
        <x-primary-button type="submit" class="my-3">{{ __('Create') }}</x-primary-button>
        <x-input-error class="mt-2" :messages="$errors->get('positionname')" />
    </form>
    @if (session('status'))
    <div>{{ session('status') }}</div>
@endif
</section>

