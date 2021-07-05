<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="#">
                <h3>E-Lang</h3>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        @if (session('exception') != null)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            {{session('exception')}}
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Telephone Number -->
            <div class="mt-4">
                <x-label for="nomor_telpon" :value="__('NomorTelpon')" />

                <x-input id="nomor_telpon" class="block mt-1 w-full" type="text" name="nomor_telpon" :value="old('nomor_telpon')" required />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="photo" :value="__('Photo')" />

                <x-input id="photo" class="block mt-1 w-full"
                                type="file"
                                name="photo" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
