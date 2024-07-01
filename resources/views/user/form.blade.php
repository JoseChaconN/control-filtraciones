<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h1>Usuario {{ $user->name }}</h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ (!empty($user->id)) ? route('user.update',$user->id) : route('user.store') }}" autocomplete="off">
	        	@csrf
	        	@if(!empty($user->id))
	        		@method('PATCH')
	        	@endif
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Nombre" value="{{ old('name',$user->name) }}" />
                            <label for="name">Nombre</label>
                            @if($errors->has('name'))
                                <span class="text-danger">*{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="{{ old('email',$user->email) }}" />
                            <label for="email">Email</label>
                            @if($errors->has('email'))
                                <span class="text-danger">*{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button class="btn btn-primary btn-block" type="submit">Guardar</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>