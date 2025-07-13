<section>
    <form method="post" action="{{ route('user-position.update', $userposition->uuid) }}">
        @csrf
        @method('put')

        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <x-input-label for="user_id" :value="__('User')" />
                <select name="user_id" class="mt-1 block w-full" required>
                    @foreach($users as $user)
                        <option value="{{ $user->uuid }}"
                            @selected($userposition->user_id == $user->uuid)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <x-input-label for="position_id" :value="__('Position')" />
                <select name="position_id" class="mt-1 block w-full" required>
                    @foreach($positions as $position)
                        <option value="{{ $position->uuid }}"
                            @selected($userposition->position_id == $position->uuid)>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <x-primary-button class="mt-4">
            {{ __('Update') }}
        </x-primary-button>
    </form>
    @if (session('status'))
    <div>{{ session('status') }}</div>
    @endif
</section>
