<div>
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Filtros</h3>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input class="form-control form-control-sm" type="text" placeholder="Buscar por flujo" wire:model.live="search" />
                        <label for="code">Nivel de Flujo</label>
                    </div>
                </div>
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
        <canvas id="flowChart"></canvas>
    </div>
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
    {{-- 
    <script>
       document.addEventListener('livewire:init', function () {
            const ctx = document.getElementById('flowChart').getContext('2d');
            const chartData = @json($wire.getChartData);

            const flowChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
--}}
    @script
    <script>
        $wire.on('chartDataUpdated', (chartData) => {
            console.log(chartData)
            ctx = document.getElementById('flowChart').getContext('2d');
            chartDataC = chartData[0];
            flowChart = new Chart(ctx, {
                type: 'bar',
                data: {
                        datasets: [{
                            data: chartData[0]['datasets'][0]['data'],
                            label: 'Flow Value',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                        }],
                        labels: chartData[0]['labels']
                    },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            
            setTimeout(() => {
                flowChart.destroy();
                flowChart = new Chart(ctx, {
                type: 'line',
                data: {
                        datasets: [{
                            data: chartData[0]['datasets'][0]['data'],
                            label: 'Sensor de Flujo',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                        }],
                        labels: chartData[0]['labels']
                    },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            }, 500);
        });
    </script>
     @endscript
</div>
