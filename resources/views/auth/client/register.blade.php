<x-app-layout>
    <x-slot name="headline">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('client.update') }}">
            @csrf

            <div class="mt-4">
                <x-label for="dateOfBirth" :value="__('Date Of Birth')" />

                <x-input id="dateOfBirth" class="block mt-1 w-full"
                                type="date"
                                name="dateOfBirth" required />
            </div>

            <div class="mt-4">
                <x-label for="sex" :value="__('Sex')" />

                <x-select id="sex" class="block mt-1 w-full"
                                name="sex" :option="['Male','Female']" required />
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" required />
            </div>

            <div class="mt-4">
                <x-label for="mobileNumber" :value="__('Mobile Number')" />

                <x-input id="mobileNumber" class="block mt-1 w-full"
                                type="tel" placeholder="+8801761572186"
                                name="mobileNumber" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update profile') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
