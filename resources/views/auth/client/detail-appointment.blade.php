<x-client-dashboard>

    <h2 class="mt-10">Workers's Bio</h2>

    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($worker)
                    <ul>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Name : {{$worker->name}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$worker->email}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$worker->mobileNumber}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">expertField : {{$worker->expertField}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Experience : {{$worker->experience}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">About me : {{$worker->aboutme}}</li>
                        <li id="total_amount" value="{{$worker->fee}}" class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"> Fee : {{$worker->fee}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$worker->address}}</li>
                    </ul>
                @endisset
            </div>
        </div>
    </div>
    @isset($appointment_id)
        <div id="appointment_id" value="{{$appointment_id}}"></div>
    @endisset

    <h2 class="mt-10">Billing Info</h2>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($client)
                    <ul>
                        <li id="customer_name" value="{{$client->name}}" class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Name : {{$client->name}}</li>
                        <li id="email" value="{{$client->email}}" class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$client->email}}</li>
                        <li id="mobile" value="{{$client->mobileNumber}}" class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$client->mobileNumber}}</li>
                        <li id="address" value="{{$client->address}}" class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$client->address}}</li>
                        <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                            <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                token="{{csrf_token()}}"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}" > Pay Now
                            </button>
                        </li>
                    </ul>
                @endisset
                <div x-data="{manualShow:false}" class="mt-10">
                    <input type="checkbox" x-on:click="manualShow=!manualShow" id="manualPayment" name="manualPayment">
                    <label for="manualPayment"> Cash Payment</label><br>
                    <div x-show="manualShow" >
                        <form  method="POST" action="{{ route('client.manual.payment') }}">
                            @csrf
                
                            <div>
                                <x-label for="appointmentFee" :value="__('Fee ')" />
                
                                <x-input id="appointmentFee" class="block mt-1 w-full" 
                                        type="number" name="appointmentFee" value="{{$worker->fee}}" required autofocus />
                            </div>

                            <div class="m-8">
                                <input type="hidden" name="appointment_id" value="{{$appointment_id}}">
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Confirm') }}
                                    </x-button>
                                 </div>
                            </div>
                        </form>
                    </div>
                </div>
                

            </div>
        </div>
    </div>

    <h2 class="mt-10">Client's Appointment History</h2>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($appoinments)
                <table class="min-w-full mt-6">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Index</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Shedule's Date</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fee</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($appoinments as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$loop->index + 1}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->date}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->fee}}</td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>   
                @endisset
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<!-- If you want to use the popup integration, -->
<script>
    function setPostData(){
        var obj = {};
        obj.cus_name = $('#customer_name').attr('value');
        obj.cus_phone = $('#mobile').attr('value');
        obj.cus_email = $('#email').attr('value');
        obj.cus_addr1 = $('#address').attr('value');
        obj.amount = $('#total_amount').attr('value');
        obj.appointment_id = $('#appointment_id').attr('value');
        $('#sslczPayBtn').prop('postdata', obj);
    }
    setPostData();
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
</x-client-dashboard>