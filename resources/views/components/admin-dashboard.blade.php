<x-app-layout>
    <x-slot name="headline">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="md:grid md:grid-cols-4 justify-center py-12">

        <div class="flex md:col-span-2 lg:col-span-1 h-auto sm:px-6 lg:px-8">
            <div class="bg-white w-full h-full overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col justify-center items-start p-6 bg-white">
                    <div class="flex justify-center">
                        <span class="text-blue-600 inline-block"><i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('admin.edit')" :active="request()->routeIs('admin.edit')">
                            {{ __('Update Profile') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-user fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('register.admin')" :active="request()->routeIs('register.admin')">
                            {{ __('Register Admin') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-search fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('admin.show.client')" :active="request()->routeIs('admin.show.client')">
                            {{ __('Search Client') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-search fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('admin.show.worker')" :active="request()->routeIs('admin.show.worker')">
                            {{ __('Search Worker') }}
                        </x-nav-link>
                    </div>

                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fas fa-adjust fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('admin.show.transactions')" :active="request()->routeIs('admin.show.transactions')">
                            {{ __('Show Transactions') }}
                        </x-nav-link>
                    </div>

                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fas fa-adjust fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('admin.show.suggestions')" :active="request()->routeIs('admin.show.suggestions')">
                            {{ __('Show Suggestions') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto md:col-span-2 lg:col-span-3 sm:px-6 lg:px-8">
            {{$slot}}
        </div>
    </div>
</x-app-layout>
