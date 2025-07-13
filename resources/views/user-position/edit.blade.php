{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User Position') }}
        </h2>
    </x-slot>
@dd($userPositions)
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    @include('user-position.partials.update-user-position-form')
                </div>
            </div>
</div>
    </div>
</x-app-layout> --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Edit User Position') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-lg font-medium text-gray-900">
                    <!-- Kirim variabel $userposition ke partial view -->
                    @include('user-position.partials.update-user-position-form', [
                        'userposition' => $userposition,
                        'users' => $users,
                        'positions' => $positions
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
