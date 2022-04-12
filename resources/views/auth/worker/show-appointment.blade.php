<x-worker-dashboard>
    @isset($appoinments)

    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        <h1 class="text-lg text-blue-900">Your Confirmed Shedules</h1>
                        @foreach ($appoinments as $item)
                        @if (!$item->isCanceled && $item->isConfirmed)

                        <h1 class="mt-4"><b> {{ $loop->index + 1 }}.Shedules</b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Clients's Name : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Clients's Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Clients's Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Appointment Date : {{$item->date}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Per Hour Fee : {{$item->fee}}</li>
                            @isset($item->address)
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Arrival Address: {{$item->address}}</li>
                            @endisset
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('worker.detail.appointment').'/'.$item->client_id.'/'.$item->appointment_id}}">Show Details</a>
                                </button>
                            </li>

                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('worker.cancel.appointment').'/'.$item->appointment_id }}">Cancel Appointment</a>
                                </button>
                            </li>
                        </ul>  
                        @endif    
                        @endforeach
                        <h1 class="text-lg text-blue-900">Your Pending Shedules</h1>
                        @foreach ($appoinments as $item)
                        @if (!$item->isCanceled && !$item->isConfirmed)

                        <h1 class="mt-4"><b> {{ $loop->index + 1 }}.Shedules</b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Clients's Name : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Clients's Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Clients's Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Appointment Date : {{$item->date}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Per Hour Fee : {{$item->fee}}</li>
                            @isset($item->address)
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Arrival Address: {{$item->address}}</li>
                            @endisset

                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('worker.detail.appointment').'/'.$item->client_id.'/'.$item->appointment_id}}">Show Details</a>
                                </button>
                            </li>

                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('worker.confirm.appointment').'/'.$item->appointment_id }}">Confirm Appointment</a>
                                </button>
                            </li>

                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('worker.cancel.appointment').'/'.$item->appointment_id }}">Cancel Appointment</a>
                                </button>
                            </li>
                        </ul>  
                        @endif    
                        @endforeach
                        <h1 class="mt-20 text-lg text-blue-900">Canceled Schedules</h1>
                        @foreach ($appoinments as $item)
                        @if ($item->isCanceled)
                        <h1 class="mt-4"><b> {{ $loop->index + 1 }}.Shedules</b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Clients's Name : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Clients's Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Clients's Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Appointment Date : {{$item->date}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Per Hour Fee : {{$item->fee}}</li>
                            @isset($item->address)
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Arrival Address: {{$item->address}}</li>
                            @endisset
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('worker.detail.appointment').'/'.$item->client_id.'/'.$item->appointment_id}}">Show Details</a>
                                </button>
                            </li>
                        </ul>
                        @endif    
                        @endforeach
                    </div>
                </div>   
            </div>
        </div>
    </div>
    @endisset
</x-worker-dashboard>