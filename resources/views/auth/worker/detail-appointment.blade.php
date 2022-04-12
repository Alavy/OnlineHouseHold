<x-worker-dashboard>

    <h2 class="mt-10">Clients's Bio</h2>

    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($client)
                    <ul>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Name : {{$client->name}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$client->email}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone Number : {{$client->mobileNumber}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Date Of Birth : {{$client->dateOfBirth}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Sex : {{$client->sex}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Address : {{$client->address}}</li>
                    </ul>
                @endisset
            </div>
        </div>
    </div>
    

    <h2 class="mt-10">Client's Appointment History</h2>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($appoinments)
                @foreach ($appoinments as $item)
                <h1 class="mt-4"><b> {{ $loop->index + 1 }}.Shedules</b>  </h1>
                <ul>
                    <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Appointment Date : {{$item->date}}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Appointment Fee : {{$item->fee}}</li>
                    @isset($item->address)
                    <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Arrival Address: {{$item->address}}</li>
                    @endisset
                </ul>
                @endforeach
                @endisset
            </div>
        </div>
    </div>
</x-worker-dashboard>