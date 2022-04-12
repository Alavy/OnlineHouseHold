<x-app-layout>
    <x-slot name="headline">
        <h2 class=" inline-block font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
        <div class="ml-4 inline-block items-center">
            <x-dropdown :align="'top'" :width="48">
                <x-slot name="trigger">

                    <a class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        href="#"><i class="lg:text-gray-700 text-gray-500 fas fa-ambulance text-lg leading-lg mr-2"></i>
                        Service Category</a>
                </x-slot>
                <x-slot name="content">
                    <div class="block">
                      <a class="block p-2" href="{{route('blog').'/1'}}">Electronics & Gadgets Repair</a>
                      <a class="block p-2" href="{{route('blog').'/2'}}">Plumber</a>
                      <a class="block p-2" href="{{route('blog').'/3'}}">Home Cleaner</a>
                      <a class="block p-2" href="{{route('blog').'/4'}}">Pest Controller</a>
                      <a class="block p-2" href="{{route('blog').'/5'}}">House Shifting</a>
                      <a class="block p-2" href="{{route('blog').'/6'}}">Electrician</a>
                      <a class="block p-2" href="{{route('blog').'/7'}}">Appliance Repair</a>
                      <a class="block p-2" href="{{route('blog').'/8'}}">Service Seeker</a>
                    </div>
                  </x-slot>
            </x-dropdown>
        </div>
    </x-slot>

    <div x-data="{notiCountMessage:0,notiShow:false,notiHeader:'',notiMessage:''}" 
    x-init="
            axios.get('{{ route('client.message.count') }}')
                        .then((response) => {
                            notiCountMessage=response.data;
                    });
            Echo.private('appoinment.{{ Auth::user()->user_identity }}')
                    .listen('AppointmentEvent', (appointment) => {
                        notiShow=true;
                        if(appointment.isCanceled){
                            notiHeader='your appointment Cancelled ';
                            notiMessage=' and your appointment Date was at '+appointment.appointmentDate;
                        }else if(appointment.isConfirmed){
                            notiHeader='Congratulation your appointment is succesfully accepted ';
                            notiMessage=' and your appointment Date was at '+appointment.appointmentDate;
                        }else{
                            notiHeader='hey you have a appointment  ';
                            notiMessage='at '+appointment.appointmentDate;
                        }
                    });
            Echo.private('message.{{ Auth::user()->user_identity }}')
                        .listen('MessageEvent', (message) => {
                            notiCountMessage++;
                            notiShow=true;
                            notiHeader='hey you have a message : ';
                            notiMessage=message.body;
                        });
                    ">

        <div x-bind:class="notiShow?'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative visible':'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative invisible'"
            role="alert">
            <strong class="font-bold" x-text="notiHeader"></strong>
            <span class="block sm:inline" x-text="notiMessage"></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" x-on:click="notiShow=false">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>

        <div class="md:grid md:grid-cols-4 justify-center py-12">

            <div class="flex md:col-span-2 lg:col-span-1 h-auto sm:px-6 lg:px-8">
                <div class="bg-white w-full h-full overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col justify-center items-start p-6 bg-white">


                        <div class="flex justify-center  mt-6">
                            <span class="text-blue-600 inline-block"><i class="fa fa-search fa-3x"
                                    aria-hidden="true"></i></span>
                            <x-nav-link class="ml-6" :href="route('client.search.worker')"
                                :active="request()->routeIs('client.search.worker')">
                                {{ __('Search Worker') }}
                            </x-nav-link>
                        </div>

                        <div class="flex justify-center  mt-6">
                            <span class="text-blue-600 inline-block"><i class="fa fa-address-book fa-3x"></i></span>
                            <x-nav-link class="ml-6" :href="route('client.show.appointment')"
                                :active="request()->routeIs('client.show.appointment')">
                                {{ __('Show My Appointments') }}
                            </x-nav-link>
                        </div>

                        <div class="flex justify-center  mt-6">
                            <span class="text-blue-600 inline-block"><i class="fa fa-bars fa-3x"
                                    aria-hidden="true"></i></span>
                            <x-nav-link class="ml-6" :href="route('client.edit')"
                                :active="request()->routeIs('client.edit')">
                                {{ __('Update My Profile') }}
                            </x-nav-link>
                        </div>
                        <div class="flex justify-center mt-6" >
                            <span class="text-blue-600 inline-block relative">
                                <i class="fa fa-comments fa-3x"></i>
                                <div class="rounded-full h-8 w-8 bg-red-600 absolute top-0 left-5">
                                    <span class="text-gray-200 pl-2 p-1" x-text="notiCountMessage"></span>
                                </div>
                            </span>
                            <x-nav-link class="ml-6" :href="route('client.chat.list')"
                                :active="request()->routeIs('client.chat.list')">
                                {{ __('Chat list') }}
                            </x-nav-link>
                        </div>

                    </div>
                </div>
            </div>
            <div class="flex-auto md:col-span-2 lg:col-span-3 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
