<x-client-dashboard>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($appoinments)
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        <h1 class="text-lg text-blue-900">Your Confirmed Schedules</h1>
                        @foreach ($appoinments as $item)
                        @if (!$item->isCanceled && $item->isConfirmed)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Appointment</b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Worker's Name :  {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Expert Field : {{$item->expertField}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Experience : {{$item->experience}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">About Me : {{$item->aboutme}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Fee : {{$item->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('client.cancel.appointment').'/'.$item->appointment_id}}">Cancel Appointment</a>
                                </button>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('client.detail.appointment').'/'.$item->worker_id.'/'.$item->appointment_id}}">Show Details</a>
                                </button>
                            </li>
                            
                        </ul>
                        @endif 
                        @endforeach
                        <h1 class="text-lg text-blue-900">Your Pending Schedules</h1>
                        @foreach ($appoinments as $item)
                        @if (!$item->isCanceled && !$item->isConfirmed)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Appointment</b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Worker's Name :  {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Expert Field : {{$item->expertField}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Experience : {{$item->experience}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">About Me : {{$item->aboutme}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Fee : {{$item->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('client.cancel.appointment').'/'.$item->appointment_id}}">Cancel Appointment</a>
                                </button>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('client.detail.appointment').'/'.$item->worker_id.'/'.$item->appointment_id}}">Show Details</a>
                                </button>
                            </li>
                            
                        </ul>
                        @endif     
                        @endforeach
                        <h1 class="mt-20 text-lg text-blue-900">Canceled Schedules</h1>
                        @foreach ($appoinments as $item)
                        @if ($item->isCanceled)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Appointment</b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Worker's Name :  {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Expert Field : {{$item->expertField}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Experience : {{$item->experience}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">About Me : {{$item->aboutme}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Fee : {{$item->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                        </ul>
                        @endif    
                        @endforeach
                    </div>
                </div>   
                @endisset
            </div>
        </div>
    </div>
</x-client-dashboard>