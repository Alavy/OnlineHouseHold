<x-app-layout>
    <x-slot name="headline">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Worker Dashboard') }}
        </h2>
    </x-slot>



    <div x-data="{notiCountAppointment:0,notiCountMessage:0,notiShow:false,notiHeader:'',notiMessage:''}"
            x-init="axios.get('{{ route('worker.appointment.count') }}')
                                .then((response) => {
                                    notiCountAppointment=response.data;
                            });
                    Echo.private('appoinment.{{ Auth::user()->user_identity }}')
                                .listen('AppointmentEvent', (appointment) => {
                                    notiCountAppointment++;
                                    notiShow=true;
                                    if(appointment.isCanceled){
                                        notiHeader='your appointment Cancelled ';
                                        notiMessage=' and your appointment Date was at '+appointment.appointmentDate;
                                    }else if(appointment.isPaidUp){
                                        notiHeader='Client Succesfully Paid your Bill';
                                        notiMessage=' Fee Was '+appointment.fee+' Taka '
                                        +'and your Appointment Date was at '+appointment.appointmentDate;
                                    }else{
                                        notiHeader='hey you have a appointment please Confirm Or Cancel it ';
                                        notiMessage='at '+appointment.appointmentDate;
                                    }
                                    
                                });
                    axios.get('{{ route('worker.message.count') }}')
                                .then((response) => {
                                    notiCountMessage=response.data;
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
                    <svg class="fill-current h-6 w-6 text-red-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                        <div class="flex justify-center mt-6">
                            
                            <span class="text-blue-600 inline-block relative">
                                <i class="fas fa-bell fa-3x"></i>
                                <div class="rounded-full h-8 w-8 bg-red-600 absolute top-0 left-5">
                                    <span class="text-gray-200 pl-2 p-1" x-text="notiCountAppointment"></span>
                                </div>
                            </span>
                            <x-nav-link class="ml-6" :href="route('worker.show.appointment')"
                                :active="request()->routeIs('worker.show.appointment')">
                                {{ __('Client Schedules') }}
                            </x-nav-link>
                        </div>
                        <div class="flex justify-center mt-6">
                            <span class="text-blue-600 inline-block"><i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                            </span>
                            <x-nav-link class="ml-6" :href="route('worker.edit')"
                                :active="request()->routeIs('worker.edit')">
                                {{ __('Update Profile') }}
                            </x-nav-link>
                        </div>
                        <div class="flex justify-center mt-6">
                            <span class="text-blue-600 inline-block relative">
                                <i class="fa fa-comments fa-3x"></i>
                                <div class="rounded-full h-8 w-8 bg-red-600 absolute top-0 left-5">
                                    <span class="text-gray-200 pl-2 p-1" x-text="notiCountMessage"></span>
                                </div>
                            </span>
                            <x-nav-link class="ml-6" :href="route('worker.chat.list')"
                                :active="request()->routeIs('worker.chat.list')">
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