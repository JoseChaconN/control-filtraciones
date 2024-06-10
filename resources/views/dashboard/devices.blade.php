<x-app-layout>
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
    
</x-app-layout>