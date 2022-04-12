<x-parent-layout>
    <div class="py-24">
        <x-auth-card>
            <x-slot name="logo">
                <a href="{{route('index')}}">
                    <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
                </a>
            </x-slot>
    
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('register')}}">
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
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
                    <div x-data="{ passShow : true }"  class="relative">
                        <button type="button"  class="absolute top-0 right-0 pr-3" x-on:click=" passShow = !passShow ">
                            <i class="fas fa-eye"></i>
                        </button>
                        <x-input id="password" class="block mt-1 w-full"
                                    x-bind:type=" passShow ? 'password':'text' "
                                    name="password"
                                    required autocomplete="new-password" />
                    </div>
                    
                </div>
    
                <!-- Confirm Password -->

                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div x-data="{ passShow : true }"  class="relative">
                        <button type="button" class="absolute top-0 right-0 pr-3" x-on:click=" passShow = !passShow ">
                            <i class="fas fa-eye"></i>
                        </button>
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                    x-bind:type=" passShow ? 'password':'text' "
                                    name="password_confirmation" required />
                    </div>
                    
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Your Role')" />
                    <div class="block mt-1 w-full">
                        <input type="radio" id="client" name="role" value="client">
                                                <label for="client">I want to hire</label><br>
                    </div>
                    <div class="block mt-1 w-full">
                        <input type="radio" id="worker" name="role" value="worker">
                                                    <label for="worker">I want to work</label><br>
                    </div >    
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('index')}}">
                        {{ __('Cancel') }}
                    </a>
                    <x-button class="ml-4">
                        {{ __('Create Profile') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card> 
    </div>
</x-parent-layout>