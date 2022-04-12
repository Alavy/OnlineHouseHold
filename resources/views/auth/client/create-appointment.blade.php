<x-client-dashboard>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form  method="POST" action="{{ route('client.create.appointment') }}">
            @csrf

            <div class="mt-4">
                <x-label for="appointmentDate" :value="__('Pick Appointment Date')" />

                <x-input
                id="appointmentDate" class="block mt-1 w-full"
                                type="date"
                                name="appointmentDate" required />
            </div>
            <div class="mt-4">
                <x-label for="appointmentTime" :value="__('Pick Appointment Time')" />

                <x-input
                id="appointmentTime" class="block mt-1 w-full"
                                type="time"
                                name="appointmentTime" required />
            </div>
            <div class="mt-4">
                <x-label for="address" :value="__('Write Down Worker Arrival Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" required />
            </div>
            <div class="m-8">
                <div>
                <input type="hidden" name="worker_id" value="{{$worker_id}}">
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                        {{ __('Cancel') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Confirm') }}
                    </x-button>
                 </div>
            </div>
        </div>
        </form>

    </x-auth-card>
</x-patient-dashboard>