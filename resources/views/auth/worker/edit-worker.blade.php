<x-worker-dashboard>
    @isset($worker)
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('worker.edit') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$worker->name" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$worker->email" required />
            </div>

            <div>
                <x-label for="perHourFee" :value="__('Per Day Fee')" />

                <x-input id="perHourFee" class="block mt-1 w-full" 
                        type="number" name="perHourFee"
                         :value="$worker->fee" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="expertField" :value="__('Expert Field')" />

                <x-select id="expertField" class="block mt-1 w-full"
                                name="expertField"
                                :value="$worker->expertField"
                    :option="['Electronics & Gadgets Repair',
                    'Plumber','Home Cleaner','Pest Controller','Painter','House Shifting','Electrician','Appliance Repair','Service Seeker']" required />
            </div>

            <div>
                <x-label for="experience" :value="__('experience')" />

                <x-input id="experience" class="block mt-1 w-full" 
                        type="text" name="experience"
                         :value="$worker->experience" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="aboutme" :value="__('About me')" />
                <x-textarea id="aboutme" class="block mt-1 w-full"
                                rows="3" cols="4" :value="$worker->aboutme"
                                name="aboutme" required />
            </div>


            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" :value="$worker->address" required />
            </div>

            <div class="mt-4">
                <x-label for="mobileNumber" :value="__('Mobile Number')" />

                <x-input id="mobileNumber" class="block mt-1 w-full"
                                type="tel" :value="$worker->mobileNumber"
                                name="mobileNumber" required />
            </div>

            <div class="mt-4" x-data="{ latitude:{{$latitude}},longitude:{{$longitude}}}" 
            x-init="(function (){
            var lonLat = ol.proj.fromLonLat([longitude, latitude]);
            var layer = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [
                        new ol.Feature({
                            geometry: new ol.geom.Point(lonLat)
                        })
                    ]
                })
            });
            map.addLayer(layer);
            map.setView(new ol.View({
                center: lonLat,
                zoom: 15
              }));
            })();
            ">

                <x-label for="loc" :value="__('Location')" />
                
                <button type="button" class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                x-on:click="
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition( 
                        (position) => {
                        latitude = position.coords.latitude;
                        longitude = position.coords.longitude;
                        var lonLat = ol.proj.fromLonLat([longitude, latitude]);

                        var layer = new ol.layer.Vector({
                            source: new ol.source.Vector({
                                features: [
                                    new ol.Feature({
                                        geometry: new ol.geom.Point(lonLat)
                                    })
                                ]
                            })
                        });
                        map.addLayer(layer);
                        map.setView(new ol.View({
                            center: lonLat,
                            zoom: 15
                          }));
                      });
                }
                ">
                    Find my Location
                </button>

                <input type="hidden" name="latitude" x-bind:value="latitude" required>
                <input type="hidden" name="longitude" x-bind:value="longitude" required>

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
            </script>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update  Profile') }}
                </x-button>
            </div>
        </form>
    </x-auth-card> 
    @endisset
</x-worker-dashboard>