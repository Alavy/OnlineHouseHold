<x-admin-dashboard>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="flex-auto py-10">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('admin.show.client') }}">
                                @csrf
                    
                                <div class="mt-4">
                                    
                                    <x-label for="searchClient" :value="__('Search Client')" />
                    
                                    <div id="searchClient" class="w-full flex justify-between">
                                        <x-input class="block mt-1 flex-auto w-2/3"
                                                    type="text"
                                                    name="searchClient" :value="old('searchClient')" required />
                                        <button type="submit" class="flex-auto w-1/3">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form> 
                </div>
                @isset($clients)
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        @foreach ($clients as $item)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Client's informations</b>  </h1>

                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Date Of Birth : {{$item->dateOfBirth}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Sex : {{$item->sex}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('admin.delete.user').'/'.$item->user_id}}">Delete Client</a>
                                </button>
                            </li>
                        </ul>    
                        @endforeach
                    </div>
                </div>   
                @endisset
            </div>
        </div>
    </div>
</x-admin-dashboard>