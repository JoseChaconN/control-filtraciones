<x-app-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Monitorización de Temperatura</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @livewire('temp-data-table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>