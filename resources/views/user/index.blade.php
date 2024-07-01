<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h3><i class="fas fa-table me-1"></i>Usuarios</h3>
                </div>
                <div class="col-md-4 text-end">
                    <a class="btn btn-success btn-sm" href="{{ route('user.create') }}">Usuario Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover data-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})"><i class="far fa-trash-alt"></i></button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('user.destroy', $item->id) }}" method="POST" style="display: none;">
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
