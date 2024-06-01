<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h1>Sector {{ $area->name }}</h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ (!empty($area->id)) ? route('area.update',$area->id) : route('area.store') }}" autocomplete="off">
	        	@csrf
	        	@if(!empty($area->id))
	        		@method('PATCH')
	        	@endif
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="code" name="code" type="text" placeholder="Código de Sector" value="{{ old('code',$area->code) }}" />
                            <label for="code">Código de Sector</label>
                            @if($errors->has('code'))
                                <span class="text-danger">*{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Nombre de Sector" value="{{ old('name',$area->name) }}" />
                            <label for="name">Nombre de Sector</label>
                            @if($errors->has('name'))
                                <span class="text-danger">*{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="regular_flow" name="regular_flow" type="text" placeholder="Flujo Regular" value="{{ old('regular_flow',$area->regular_flow) }}" />
                            <label for="regular_flow">Flujo Regular</label>
                            @if($errors->has('regular_flow'))
                                <span class="text-danger">*{{ $errors->first('regular_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="peak_flow" name="peak_flow" type="text" placeholder="Flujo Maximo" value="{{ old('peak_flow',$area->peak_flow) }}" />
                            <label for="peak_flow">Flujo Maximo</label>
                            @if($errors->has('peak_flow'))
                                <span class="text-danger">*{{ $errors->first('peak_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="minimum_flow" name="minimum_flow" type="text" placeholder="Flujo Minimo" value="{{ old('minimum_flow',$area->minimum_flow) }}" />
                            <label for="minimum_flow">Flujo Minimo</label>
                            @if($errors->has('minimum_flow'))
                                <span class="text-danger">*{{ $errors->first('minimum_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="description" name="description" type="text" placeholder="Descripción" value="{{ old('description',$area->description) }}" />
                            <label for="description">Descripción</label>
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