<x-parent-layout>
    <x-auth-card class="w-full">

        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
            </a>
        </x-slot>
        
        @isset($message)
        <div class="min-w-full">
            <div class="bg-white p-12">
                <h2 class="font-bold">Transaction Status</h2>
                <ul>
                    @foreach ($message as $item)
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$loop->index}}. {{ $item }}</li>
                    @endforeach
                </ul>
               
                
            </div>
        </div>
    @endisset
    </x-auth-card>
</x-parent-layout>
