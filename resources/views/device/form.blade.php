<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dispositivo {{ $device->name }}</h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ (!empty($device->id)) ? route('device.update',$device->id) : route('device.store') }}" autocomplete="off">
	        	@csrf
	        	@if(!empty($device->id))
	        		@method('PATCH')
	        	@endif
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="code" name="code" type="text" placeholder="Código de Dispositivo" value="{{ old('code',$device->code) }}" />
                            <label for="code">Código de Dispositivo</label>
                            @if($errors->has('code'))
                                <span class="text-danger">*{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Nombre de Dispositivo" value="{{ old('name',$device->name) }}" />
                            <label for="name">Nombre de Dispositivo</label>
                            @if($errors->has('name'))
                                <span class="text-danger">*{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="area_id" name="area_id" aria-label="Floating label select example">
                                <option value="">Sector</option>
                                @foreach ($area as $item)
                                    <option {{ old('area_id', $device->area_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="area_id">Sector</label>
                            @if($errors->has('area_id'))
                                <span class="text-danger">*{{ $errors->first('area_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="regular_flow" name="regular_flow" type="text" placeholder="Flujo Regular" value="{{ old('regular_flow',$device->regular_flow) }}" />
                            <label for="regular_flow">Flujo Regular</label>
                            @if($errors->has('regular_flow'))
                                <span class="text-danger">*{{ $errors->first('regular_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="peak_flow" name="peak_flow" type="text" placeholder="Flujo Maximo" value="{{ old('peak_flow',$device->peak_flow) }}" />
                            <label for="peak_flow">Flujo Maximo</label>
                            @if($errors->has('peak_flow'))
                                <span class="text-danger">*{{ $errors->first('peak_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="minimum_flow" name="minimum_flow" type="text" placeholder="Flujo Minimo" value="{{ old('minimum_flow',$device->minimum_flow) }}" />
                            <label for="minimum_flow">Flujo Minimo</label>
                            @if($errors->has('minimum_flow'))
                                <span class="text-danger">*{{ $errors->first('minimum_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="description" name="description" type="text" placeholder="Descripción" value="{{ old('description',$device->description) }}" />
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