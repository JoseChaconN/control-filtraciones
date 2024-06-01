<x-app-layout>
    @php
    // Convertir las colecciones de configuraciones en mapas
        $channelMap = $channels->pluck('name', 'id');
        $typeMap = $types->pluck('name', 'id');
        $levelMap = $levels->pluck('name', 'id');
    @endphp
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <i class="fas fa-table me-1"></i>
                    Alertas
                </div>
                <div class="col-md-4 text-end">
                    <a class="btn btn-success btn-sm" href="{{ route('alert.create') }}">Alerta Nueva</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover data-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Mensaje</th>
                        <th>Canales</th>
                        <th>Tipo de Alerta</th>
                        <th>Nivel de Alerta</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->message }}</td>
                            <td>
                                @foreach (json_decode($item->channel) as $channelId)
                                    {{ $channelMap[$channelId] ?? 'Unknown' }}@if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>{{ $typeMap[$item->type] ?? 'Unknown' }}</td>
                            <td>{{ $levelMap[$item->level] ?? 'Unknown' }}</td>
                            <td>
                                <a href="{{ route('alert.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})"><i class="far fa-trash-alt"></i></button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('alert.destroy', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
