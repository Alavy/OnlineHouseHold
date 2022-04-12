<x-client-dashboard>
    @isset($client)
        <div class="min-w-full">
            <div class="bg-white p-12">
                <h2 class="font-bold">Client's Bio</h2>
                <ul>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Name : {{ $client->name }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{ $client->email }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone Number : {{ $client->mobileNumber }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Date Of Birth : {{ $client->dateOfBirth }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Sex : {{ $client->sex }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Address : {{ $client->address }}</li>
                </ul>
            </div>
        </div>
    @endisset
</x-client-dashboard>
