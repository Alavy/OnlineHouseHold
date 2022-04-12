<x-admin-dashboard>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($suggestions)
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        @foreach ($suggestions as $item)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Suggestion Info: </b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->contractEmail}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Suggestion : {{$item->message}}</li>
                            </ul>    
                        @endforeach
                        </div>
                    </div>   
                @endisset
            </div>
        </div>
    </div>
</x-admin-dashboard>