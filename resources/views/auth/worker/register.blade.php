<x-app-layout>
    <x-slot name="headline">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Worker Dashboard') }}
        </h2>
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('worker.update') }}">
            @csrf

            <div>
                <x-label for="perHourFee" :value="__('Per Day Fee')" />

                <x-input id="perHourFee" class="block mt-1 w-full" 
                        type="number" name="perHourFee"
                         :value="old('perHourFee')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="expertField" :value="__('Expert Field')" />

                <x-select id="expertField" class="block mt-1 w-full"
                                name="expertField" 
                    :option="['Electronics & Gadgets Repair',
                    'Plumber','Home Cleaner','Pest Controller','Painter',
                    'House Shifting','Electrician','Appliance Repair','Service Seeker']" required />
            </div>

            <div class="mt-4">
                <x-label for="aboutme" :value="__('About Me')" />
                <x-textarea id="aboutme" class="block mt-1 w-full"
                                rows="3" cols="4" :value="'Obedient '"
                                name="aboutme" required />
            </div>

            <div>
                <x-label for="experience" :value="__('Experience')" />

                <x-input id="experience" class="block mt-1 w-full" 
                        type="text" name="experience"
                         :value="old('experience')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" required />
            </div>

            <div class="mt-4">
                <x-label for="mobileNumber" :value="__('Mobile Number')" />

                <x-input id="mobileNumber" class="block mt-1 w-full"
                                type="tel" placeholder="+8801761572186"
                                name="mobileNumber" required />
            </div>

            <div class="mt-4" x-data="{ latitude:null,longitude:null}">

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

                <input type="hidden" id="latitude" name="latitude" x-bind:value="latitude" required>
                <input type="hidden" id="longitude" name="longitude" x-bind:value="longitude" required>

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

            <div class="flex items-center justify-end mt-4 mb-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                    {{ __('Cancel') }}
                </a>

                <x-button class="ml-4">
                    {{ __('update Profile') }}
                </x-button>
            </div>
        </form>
    </x-auth-card> 
</x-app-layout>