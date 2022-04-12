<x-client-dashboard>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            @if (isset($latitude))
                <div x-data="{ latitude:{{$latitude}},longitude:{{$longitude}}}" 
                x-init="(function (){
                let lonLat = ol.proj.fromLonLat([longitude, latitude]);
                let layer = new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: [
                            new ol.Feature({
                                geometry: new ol.geom.Point(lonLat)
                            })
                        ]
                    }),
                    style: style,
                });
                if(layerArray.length>0){
                    map.removeLayer(layerArray[layerArray.length-1]);
                }
                map.addLayer(layer);
                layerArray.push(layer);
                map.setView(new ol.View({
                    center: lonLat,
                    zoom: 15
                  }));
                                    
                })();
                " 
                class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg" > 
            @else
                <div x-data="{ latitude:null,longitude:null}" class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
            @endif
            <h2 class="font-medium p-6 text-lg text-green-600">Find your Location First or Just select your desired Location</h2>
                <div class="flex-auto py-10">
                    <div class="mt-4">

                        <x-label for="loc" :value="__('Location')" />
                        
                        <button type="button" class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                        x-on:click="
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition( 
                                (position) => {
                                latitude = position.coords.latitude;
                                longitude = position.coords.longitude;
                                let lonLat = ol.proj.fromLonLat([longitude, latitude]);
                                let layer = new ol.layer.Vector({
                                    source: new ol.source.Vector({
                                        features: [
                                            new ol.Feature({
                                                geometry: new ol.geom.Point(lonLat)
                                            })
                                        ]
                                    }),
                                    style: style,
                                });
                                if(layerArray.length>0){
                                    map.removeLayer(layerArray[layerArray.length-1]);
                                }
                                map.addLayer(layer);
                                layerArray.push(layer);
                                map.setView(new ol.View({
                                    center: lonLat,
                                    zoom: 15
                                  }));
                              });
                        }
                        ">
                            Find my Location
                        </button>
    
        
                    </div>
        
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.9.0/css/ol.css" type="text/css">
                    <style>
                        .map {
                            height: 400px;
                            width: 100%;
                        }
                    </style>
        
                    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.9.0/build/ol.js"></script>
        
                    <div id="map" class="map"></div>
                    <script type="text/javascript">
                        var map = new ol.Map({
                            target: 'map',
                            layers: [
                                new ol.layer.Tile({
                            source: new ol.source.OSM()
                        })
                        ],
                        view: new ol.View({
                            center: ol.proj.fromLonLat([90.213265, 23.158588]),
                            zoom: 10
                        })
                    });
                    var layerArray=[];
                    var style = new ol.style.Style({
                                        
                                        image: new ol.style.Circle({
                                            radius: 10,
                                            fill: new ol.style.Fill({
                                                    color: 'rgb(227,38,54)',
                                            }),
                                        }),
                                    });
                    map.on('click',function (evt){
                        let coordinate = ol.proj.transform(evt.coordinate,'EPSG:3857','EPSG:4326');
                        latitude = coordinate[1];
                        longitude = coordinate[0];


                        document.getElementById('latitude').value=latitude;
                        document.getElementById('longitude').value=longitude;

                        let lonLat = ol.proj.fromLonLat([longitude, latitude]);
                        let layer = new ol.layer.Vector({
                                    source: new ol.source.Vector({
                                        features: [
                                            new ol.Feature({
                                                geometry: new ol.geom.Point(lonLat)
                                            })
                                        ]
                                    }),
                                    style: style,
                                });
                        if(layerArray.length>0){
                            map.removeLayer(layerArray[layerArray.length-1]);
                        }
                        map.addLayer(layer);
                        layerArray.push(layer);
                    });
                    </script>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('client.search.worker') }}">
                                @csrf
                    
                                <div class="mt-4">
                                    
                                    <x-label for="searchWorker" :value="__('Search Worker')" />
                    
                                    <div id="searchWorker" class="w-full flex justify-between">
                                        <x-input class="block mt-1 flex-auto w-2/3"
                                                    type="text"
                                                    name="searchWorker" :value="old('searchWorker')" required />
                                        <button type="submit" class="flex-auto w-1/3">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                        <input type="hidden" id="latitude" name="latitude" x-bind:value="latitude" required>
                                        <input type="hidden" id="longitude" name="longitude" x-bind:value="longitude" required>
                                    </div>
                                </div>
                            </form> 
                </div>
                @isset($workers)
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        @foreach ($workers as $item)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Workers's informations </b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Expert Field : {{$item->expertField}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Experience : {{$item->experience}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">About Me : {{$item->aboutme}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Fee : {{$item->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-red-900 font-bold text-sm leading-5">Distance From You : {{$distances[$loop->index]}} Miles away </li>

                            <div class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                    <a href="{{route('client.create.appointment').'/'.$item->id}}">Create Appointment</a>
                                </button>
                            </div>
                            </ul>    
                        @endforeach
                        </div>
                    </div>   
                @endisset
            </div>
        </div>
    </div>
</x-client-dashboard>