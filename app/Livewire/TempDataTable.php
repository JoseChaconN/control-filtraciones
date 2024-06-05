<?php

namespace App\Livewire;

use App\Models\TempData;
use App\Models\Area;
use App\Models\Device;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class TempDataTable extends Component
{
    use WithPagination;
    public $search = '';
    public $areaFilter = '';
    public $deviceFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    
   

    public function render()
    {
        $query = TempData::with(['area', 'device'])
            ->when($this->search, function ($query) {
                $query->where('temperature', 'like', '%' . $this->search . '%');
            })
            ->when($this->areaFilter, function ($query) {
                $query->where('area_id', $this->areaFilter);
            })
            ->when($this->deviceFilter, function ($query) {
                $query->where('device_id', $this->deviceFilter);
            })->when($this->dateFrom && $this->dateTo, function ($query) {
                $query->whereBetween('created_at', [$this->dateFrom, $this->dateTo]);
            });

        $tempData = $query->paginate(10);

        return view('livewire.temp-data-table', [
            'tempData' => $tempData,
            'areas' => Area::all(),
            'devices' => Device::all(),
            'chartDataR' => $this->getChartData(),
        ]);
    }
   
    #[On('chartDataUpdated')] 
    public function getChartData()
    {
        $data = TempData::selectRaw('DATE(created_at) as date, (temperature) as total_temp')
            ->when($this->search, function ($data) {
                $data->where('temperature', 'like', '%' . $this->search . '%');
            })
            ->when($this->areaFilter, function ($data) {
                $data->where('area_id', $this->areaFilter);
            })
            ->when($this->deviceFilter, function ($data) {
                $data->where('device_id', $this->deviceFilter);
            })->when($this->dateFrom && $this->dateTo, function ($data) {
                $data->whereBetween('created_at', [$this->dateFrom, $this->dateTo]);
            })
            ->orderBy('date');
            #->paginate(100);

        $result = [
            'labels' => $data->pluck('date'),
            'datasets' => [
                [
                    'label' => 'Flow Value',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'data' => $data->pluck('total_temp'),
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
