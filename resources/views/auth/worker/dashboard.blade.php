<x-worker-dashboard>
    @isset($worker)
                <div class="min-w-full">
                    <div class="bg-white p-12">
                        <h1 class="font-bold">Workers's informations</h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$worker->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$worker->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$worker->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">expertField : {{$worker->expertField}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Experience : {{$worker->experience}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">About me : {{$worker->aboutme}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Per Hour Fee : {{$worker->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$worker->address}}</li>
                            
                            </ul>    
                        </div>
                    </div>   
                @endisset
</x-worker-dashboard>