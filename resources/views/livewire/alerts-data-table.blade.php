<div>
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Filtros</h3>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" wire:model.live="levellFilter">
                            <option value="">Nivel de Alerta</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <label for="type">Areas</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" wire:model.live="typeFilter">
                            <option value="">Tipo de Alerta</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <label for="type">Areas</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" wire:model.live="areaFilter">
                            <option value="">Todos las Áreas</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <label for="type">Areas</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" wire:model.live="deviceFilter">
                            <option value="">Todos los Dispositivos</option>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
                        <label for="type">Dispositivos</label>
                        @if($errors->has('level'))
                            <span class="text-danger">*{{ $errors->first('level') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input class="form-control form-control-sm" type="datetime-local" placeholder="Buscar por flujo" wire:model.live="dateFrom" />
                        <label for="code">Fecha Desde</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input class="form-control form-control-sm" type="datetime-local" placeholder="Buscar por flujo" wire:model.live="dateTo" />
                        <label for="code">Fecha Hasta</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12"><hr></div>
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Area</th>
                    <th>Dispositivo</th>
                    <th>Sensor de Flujo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flowData as $data)
                    <tr>
                        <td>{{ $data->area->name }}</td>
                        <td>{{ $data->device->name }}</td>
                        <td>{{ $data->flow_sensor }}</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $flowData->links() }}
    </div>
</div>
