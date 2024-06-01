<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h3">Alerta {{ $alert->name }}</h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ (!empty($alert->id)) ? route('alert.update',$alert->id) : route('alert.store') }}" autocomplete="off">
	        	@csrf
	        	@if(!empty($alert->id))
	        		@method('PATCH')
	        	@endif
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="code" name="code" type="text" placeholder="Código de Alerta" value="{{ old('code',$alert->code) }}" />
                            <label for="code">Código de Alerta</label>
                            @if($errors->has('code'))
                                <span class="text-danger">*{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input class="form-control" id="message" name="message" type="text" placeholder="Mensaje de Dispositivo" value="{{ old('message',$alert->message) }}" />
                            <label for="name">Mensaje de Dispositivo</label>
                            @if($errors->has('message'))
                                <span class="text-danger">*{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="level" name="level" aria-label="Floating label select example">
                                <option value="">Nivel de Alerta</option>
                                @foreach ($levels as $item)
                                    <option {{ old('level', $alert->level) == $item['id'] ? 'selected' : '' }} value="{{$item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="type">Nivel de Alerta</label>
                            @if($errors->has('level'))
                                <span class="text-danger">*{{ $errors->first('level') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="type" name="type" aria-label="Floating label select example">
                                <option value="">Tipo de Alerta</option>
                                @foreach ($types as $item)
                                    <option {{ old('type', $alert->type) == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="type">Tipo de Alerta</label>
                            @if($errors->has('type'))
                                <span class="text-danger">*{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="description" name="description" type="text" placeholder="Descripción" value="{{ old('description',$alert->description) }}" />
                            <label for="description">Descripción</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h2 class="h3">Canales de notificación</h2>
                    </div>
                    <div class="col-md-12">
                        @if($errors->has('channels'))
                            <span class="text-danger">*{{ $errors->first('channels') }}</span>
                        @endif
                        <div class="col-md-6">
                            <div class="row">
                                @foreach ($channels as $item)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}" id="flexCheckChannel_{{ $item['id'] }}" name="channel[]" @if(is_array(old('channel', json_decode($alert->channel, true))) && in_array($item['id'], old('channel', json_decode($alert->channel, true)))) checked @endif>
                                            <label class="form-check-label" for="flexCheckChannel_{{ $item['id'] }}">
                                                {{ $item['name'] }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>  
                {{--              
                <div class="row mb-3">
                    <div class="col-md-12"><h1 class="h3">Parametros para notificar</h1></div>
                </div>
                <div class="row mb-3">
                    @foreach ($parameters as $item)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}" id="flexCheckDefault_{{ $item['id'] }}" name="areas[]">
                                <label class="form-check-label" for="flexCheckDefault_{{ $item['id'] }}">
                                    {{ $item['name'] }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                    {{--
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="regular_flow" name="regular_flow" type="text" placeholder="Flujo Regular" value="{{ old('regular_flow',$alert->regular_flow) }}" />
                            <label for="regular_flow">Flujo Regular</label>
                            @if($errors->has('regular_flow'))
                                <span class="text-danger">*{{ $errors->first('regular_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="peak_flow" name="peak_flow" type="text" placeholder="Flujo Maximo" value="{{ old('peak_flow',$alert->peak_flow) }}" />
                            <label for="peak_flow">Flujo Maximo</label>
                            @if($errors->has('peak_flow'))
                                <span class="text-danger">*{{ $errors->first('peak_flow') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="minimum_flow" name="minimum_flow" type="text" placeholder="Flujo Minimo" value="{{ old('minimum_flow',$alert->minimum_flow) }}" />
                            <label for="minimum_flow">Flujo Minimo</label>
                            @if($errors->has('minimum_flow'))
                                <span class="text-danger">*{{ $errors->first('minimum_flow') }}</span>
                            @endif
                        </div>
                    </div> -- }}
                    
                </div> --}}
                <div class="row mb-3">
                    <div class="col-md-12"><hr></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12"><h1 class="h3">Sectores para notificar</h1></div>
                </div>
                <div class="row-mb-3">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Marcar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($area as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="flexCheckArea_{{ $item->id }}" name="areas[]" {{ in_array($item->id, old('areas', $alert->areas->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckArea_{{ $item->id }}">
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12"><hr></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12"><h1 class="h3">Dispositivos para notificar</h1></div>
                </div>
                <div class="row-mb-3">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Área</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Marcar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($device as $item)
                                    <tr>
                                        <td>{{ $item->area->name }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="flexCheckDevice_{{ $item->id }}" name="devices[]" {{ in_array($item->id, old('devices', $alert->devices->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDevice_{{ $item->id }}">
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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