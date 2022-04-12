<x-parent-layout>
    
    <x-auth-card class="w-full">
        @isset($succes)
        <div class="font-medium p-6 text-lg text-green-600">
            {{$succes}}
        </div>
        @endisset
        
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
        @isset($city)
            <h1>{{$city}}</h1>
        @endisset
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full " type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <div x-data="{ passShow : true }"  class="relative">
                    <button type="button" class="absolute top-0 right-0 pr-3" x-on:click=" passShow = !passShow ">
                        <i class="fas fa-eye"></i>
                    </button>
                    <x-input id="password" class="block mt-1 w-full"
                                x-bind:type=" passShow ? 'password':'text' "
                                name="password"
                                required autocomplete="current-password" />
                </div>
                
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-parent-layout>