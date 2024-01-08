<?php

namespace App\Http\Livewire\Supervisors;

use Livewire\Component;
use App\Models\City;
use App\Models\User;
use Livewire\WithPagination;
use App\Exports\SupervisorsExport;
use Excel;
use App\Http\Livewire\WithResetPage;
use Illuminate\Support\Collection;
class ListAllSupervisors extends Component
{
    use WithPagination, WithResetPage;
    public $search = '';
    public $rows = 10; 
    public $city = 'all';
    public $area = 'all';
    public $scope = 'all';
    public Collection $areas;
    public Collection $cities;
    public array $scopes;

    protected static array $resetPageTarget = ['search', 'rows', 'area', 'city', 
    'scope'];


    protected $listeners = ['exportSupervisors' => 'generateExcelSheet'];

    public function generateExcelSheet()
    {
        $supervisors = $this->generateSupervisorQuery()->get();
        return Excel::download(new SupervisorsExport($supervisors), 'supervisors.xlsx');
    }


    public function mount()
    {
        $this->areas = City::where('type' , 'area' )->get();
        $this->cities = collect();
        $this->scopes = User::SCOPES;
    }


    protected $paginationTheme = 'bootstrap';

    protected function generateSupervisorQuery()
    {
        $supervisors = User::query()
        ->with('area', 'city')
        ->withCount('associations')
        ->where('type', User::SUPERVISOR);


        if ($this->search != '') {
            $supervisors = $supervisors->where('email','like', '%' . $this->search . '%' )
            ->orWhere('phone' , 'like', '%' . $this->search . '%' );
        }
        if ($this->city != 'all') {
            $supervisors = $supervisors->where('city_id' , $this->city );          ;
        }
        if ($this->area != 'all') {
            $supervisors = $supervisors->where('area_id' , $this->area );
        }
        if ($this->scope != 'all') {
            $supervisors = $supervisors->where('scope' , $this->scope );
        }
        $supervisors = $supervisors->latest('id');
        return $supervisors;
    }


    public function render()
    {
        
        $supervisors = $this->generateSupervisorQuery()->paginate($this->rows);

        return view('livewire.supervisors.list-all-supervisors', compact('supervisors'));
    }
}
