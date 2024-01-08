<?php

namespace App\Http\Livewire\Associations;

use App\Http\Livewire\WithResetPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\City;
use App\Models\User;
use Livewire\WithPagination;
use App\Exports\AssociationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
class ListAllAssociations extends Component
{
    use WithPagination, WithResetPage;
    public $search = '';
    public $createdFrom = '';
    public $createdTo = '';
    public $associationName = '';
    public int $rows = 10;
    public $city = 'all';
    public $area = 'all';
    public $section = 'all';
    public Collection $areas;
    public Collection $cities;
    public array $sections;
    public bool $canCreateOrEditOrDelete = false;

    protected static array $resetPageTarget = ['search', 'rows', 'area', 'city',
    'section'];
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['exportAssociations' => 'generateExcelSheet'];

    final public function mount(): void
    {
        $this->areas = City::where('type' , 'area' )->get();
        $this->cities = collect();
        $this->sections = User::SECTIONS;
    }


    public function generateExcelSheet()
    {

        return Excel::download(new AssociationsExport($this->generateAssociationQuery()), 'associations.xlsx');
    }


    protected function generateAssociationQuery(): Builder
    {
        $user = Auth::user();


        $associations = User::query()
        ->with('area', 'city')
        ->where('type', User::ASSOCIATION);

        if ($user->type === User::SUPERVISOR) {

            switch ($user->scope) {
                case User::SCOPE_SECTION:
                $associations->where(function($query) use($user) {
                    $query->where('section' , $user->section );
                });
                break;
                case User::SCOPE_LIMIT:
                $associations->where(function($query) use($user){
                    $query->where('supervisor_id'  , $user->id );
                });
                break;
                break;
            }
        }

        if ($this->search !== '') {
            $associations = $associations->where(function($query){
                $query->where ('email','like', '%' . $this->search . '%')
                ->orWhere('phone' , 'like', '%' . $this->search . '%' )
                ->orWhere('number' , 'like', '%' . $this->search . '%' );
            });
        }
        if ($this->associationName !== '') {
            $associations = $associations->where(function($query){
                $query->where ('name','like', '%' . $this->associationName . '%');
            });
        }
        if ($this->createdFrom !== '') {
            $associations = $associations->where(function($query){
                $query->whereDate('created_at','>=', $this->createdFrom );
            });
        }
        if ($this->createdTo !== '') {
            $associations = $associations->where(function($query){
                $query->whereDate('created_at','<=', $this->createdTo );
            });
        }
        if ($this->city !== 'all') {
            $associations = $associations->where('city_id' , $this->city );
        }
        if ($this->area !== 'all') {
            $associations = $associations->where('area_id' , $this->area );
        }
        if ($this->section !== 'all') {
            $associations = $associations->where('section' , $this->section );
        }
        return $associations->latest('id');
    }


    public function render()
    {
        $associations = $this->generateAssociationQuery()->paginate(min(max($this->rows, 5), 500));
        return view('livewire.associations.list-all-associations', compact('associations' ));
    }
}
