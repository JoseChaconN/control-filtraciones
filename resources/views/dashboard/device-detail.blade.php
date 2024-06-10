<x-app-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Dispositivo - {{ $device->name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.device.detail',$device) }}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control form-control-sm" type="datetime-local" placeholder="Buscar por flujo" name="start_date" value="{{ request('start_date') }}" />
                                    <label for="code">Fecha Desde</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control form-control-sm" type="datetime-local" placeholder="Buscar por flujo" name="end_date" value="{{ request('end_date') }}" />
                                    <label for="code">Fecha Hasta</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Sensor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($flowData as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ number_format($item->flow_sensor,0,',','.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>