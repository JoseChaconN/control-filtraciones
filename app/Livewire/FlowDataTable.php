<?php

namespace App\Livewire;

use App\Models\FlowData;
use App\Models\Area;
use App\Models\Device;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class FlowDataTable extends Component
{
    use WithPagination;
    public $search = '';
    public $areaFilter = '';
    public $deviceFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    
   

    public function render()
    {
        $query = FlowData::with(['area', 'device'])
            ->when($this->search, function ($query) {
                $query->where('flow_sensor', 'like', '%' . $this->search . '%');
            })
            ->when($this->areaFilter, function ($query) {
                $query->where('area_id', $this->areaFilter);
            })
            ->when($this->deviceFilter, function ($query) {
                $query->where('device_id', $this->deviceFilter);
            })->when($this->dateFrom, function ($query) {
                $query->whereDate('created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('created_at', '<=', $this->dateTo);
            });

        $flowData = $query->paginate(10);

        return view('livewire.flow-data-table', [
            'flowData' => $flowData,
            'areas' => Area::all(),
            'devices' => Device::all(),
            'chartDataR' => $this->getChartData(),
        ]);
    }
   
    #[On('chartDataUpdated')] 
    public function getChartData()
    {
        $data = FlowData::selectRaw('DATE(created_at) as date, (flow_sensor) as total_flow')
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('created_at', '<=', $this->dateTo);
            })
            ->orderBy('date')
            ->paginate(10);

        $result = [
            'labels' => $data->pluck('date'),
            'datasets' => [
                [
                    'label' => 'Flow Value',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'data' => $data->pluck('total_flow'),
                ],
            ],
        ];
        return ($result);
    }
    public function updated(){
        $this->dispatch('chartDataUpdated', $this->getChartData());
    }
    public function mount(){
        
        if (empty($this->dateFrom)) {
            $this->dateFrom = Carbon::yesterday()->toDateString();
        }
        if (empty($this->dateTo)) {
            $this->dateTo = Carbon::today()->toDateString();
        }
        $this->dispatch('chartDataUpdated', $this->getChartData());
        
    }
    public function updatingPage($page)
    {
        // Runs before the page is updated for this component...
        $this->dispatch('chartDataUpdated', $this->getChartData());
    }
}
