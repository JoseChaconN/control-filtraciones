<x-app-layout>
    <style>
        #map {
            height: 700px;
            width: 100%;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Mapa de dispositivos</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="{{ count($areas)+2 }}" class="text-center">Leyenda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($areas as $item)
                                            
                                                <td><img src="/img/pin-{{ $item->id == 1 ? 'blue' : 'green' }}.png"></td>
                                                <td>{{ $item->name }}</td>
                                            
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Dispositivos</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Sector</th>
                                    <th>Dispositivo</th>
                                    <th>Estado</th>
                                    <th>Flujo actual</th>
                                    <th>Última actualización</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $item)
                                    <tr>
                                        <td>{{ $item->area->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{!! \App\Helpers\AppHelper::getConnectionStatus($item->latestFlowData) !!}</td>
                                        <td>{{ (!empty($item->latestFlowData->flow_sensor)) ? number_format($item->latestFlowData->flow_sensor,2).' LPM' : 'Sin Información' }}</td>
                                        <td>{!! \App\Helpers\AppHelper::getLastUpdate($item->latestFlowData) !!}</td>
                                        <td><a class="btn btn-primary btn-sm" href="{{ route('dashboard.device.detail',$item) }}">Ver Detalle</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Dispositivos</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($devices as $item)
                            <div class="col-md-4">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                    <div class="col-md-4 p-2">
                                        <img src="/img/device_2.png" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text mb-0"><strong>Sector:</strong> {{ $item->area->name }}</p>
                                            <p class="card-text mb-0"><strong>Estado:</strong>
                                                {!! \App\Helpers\AppHelper::getConnectionStatus($item->latestFlowData) !!}
                                            </p>
                                            <p class="card-text"><strong>Flujo actual:</strong> {{ (!empty($item->latestFlowData->flow_sensor)) ? number_format($item->latestFlowData->flow_sensor,2).' LPM' : 'Sin Información' }}</p>
                                            <p class="card-text"><small class="text-muted">Última actualización: {!! \App\Helpers\AppHelper::getLastUpdate($item->latestFlowData) !!}</small></p>
                                            <a class="btn btn-primary btn-sm" href="{{ route('dashboard.device.detail',$item) }}">Ver Detalle</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyCxYZ52kTu1VjGezIn_VcKJj-b-aUfMVhY", v: "weekly"});</script>
    <script>
        // Initialize and add the map
        let map;
        const devices = @json($devices_map);
        async function initMap() {
            // The location of Uluru
            const position = { lat: -33.5106833, lng: -70.6063306 };
            // Request needed libraries.
            //@ts-ignore
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
                        "marker",
                    );

            // The map, centered at Uluru
            map = new Map(document.getElementById("map"), {
                zoom: 17,
                center: position,
                mapId: "DEMO_MAP_ID",
                mapTypeId: 'satellite',
            });
            devices.forEach(device => {
                glyphColor = "white";
                if(device.area_id === 1 ){
                    background = "#0288D1";
                    borderColor = "#0277BD";
                }else{
                    background = "#388E3C";
                    borderColor = "#2E7D32";
                }
                const pinStyle = new PinElement({
                    background: background,
                    glyphColor: glyphColor,
                    borderColor: borderColor,
                });
                const marker = new AdvancedMarkerElement({
                    map: map,
                    position: { lat: device.latitude, lng: device.longitude },
                    title: device.name,
                    content: pinStyle.element,
                });

                const infowindow = new google.maps.InfoWindow({
                    //content: `<div><h1>${device.name}</h1><p>${device.code}</p></div>`
                    content: `  <div>
                                    <p><strong>Dispositivo:</strong> ${device.name}</p>
                                    <p><strong>Estado:</strong> ${device.connection_status}</p>
                                    <p><strong>Flujo actual:</strong> ${device.latest_flow_data}</p>
                                    <p><strong>Última actualización:</strong> ${device.last_connection}</p>
                                </div>`
                });

                marker.addListener('click', () => {
                    infowindow.open(map, marker);
                });
            });
            // The marker, positioned at Uluru
            /*const marker = new AdvancedMarkerElement({
                map: map,
                position: position,
                title: "Uluru",
            });*/
        }

        initMap();
    </script>
</x-app-layout>