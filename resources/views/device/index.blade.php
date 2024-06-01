<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <i class="fas fa-table me-1"></i>
                    Dispositivos
                </div>
                <div class="col-md-4 text-end">
                    <a class="btn btn-success btn-sm" href="{{ route('device.create') }}">Dispositivo Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover data-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Área</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->area->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="{{ route('device.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})"><i class="far fa-trash-alt"></i></button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('device.destroy', $item->id) }}" method="POST" style="display: none;">
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
