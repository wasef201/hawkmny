<?php

namespace App\Http\Livewire\Admin\SiteSettings;

use App\Models\SiteDynamicSettings;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

abstract class BaseDynamicSettings extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['paginate_updated', 'delete'];
    public $search = '';
    public $rows = 25;
    public $edit_row=[
        'id'=>'',
        'image'=>'',
        'title'=>'',
        'description' =>'',
        'active' =>1
    ];
    public $new_row=[
        'id'=>'',
        'image'=>'',
        'title'=>'',
        'description' =>'',
        'active' =>1
    ];
    public $status=1;


    public $dynamicSettingsKey=SiteDynamicSettings::SLIDER1;

    public $columns=[
        'image',
        'description',
        'title',
    ];
    public $pageTitle='';

    public function updatedNewRowImage()
    {
        $this->validate([
            'new_row.image' => 'image|max:3000|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }

    public function updatedEditRowImage()
    {
        $this->validate([
            'edit_row.image' => 'image|max:3000|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }

    public function mount()
    {

    }

    public function change_status($active)
    {
        $this->edit_row = [
            'id' => $this->edit_row['id'],
            'title' => $this->edit_row['title'],
            'active' => $active,
        ];
    }

    public function delete($id)
    {
        $item = SiteDynamicSettings::findOrFail($id);
        try {
            $item->delete();
            \Storage::disk('public')->delete('images/site-settings/' . $item->getAttributes()['image']);
            $this->emit('alert', ['type' => 'success', 'message' => __('message.success_response_message')]);
        } catch (\Throwable  $e) {
            $this->emit('alert', ['type' => 'error', 'message' => __('message.cant_delete')]);
        }
    }

    public function paginate_updated($data)
    {
        $this->search = $data['search'];
        $this->rows = $data['rows'];
    }

    public function store()
    {
//        $this->validate([
//            'new_row.title' => ["required", "min:3", "max:255"],
//            'new_row.description' => ["required", "min:3"],
//            'new_row.image' => 'required|image|max:3000|mimes:jpg,png,jpeg,gif,svg',
//        ]);
        $image_name = $this->new_row['image']->store('images/site-settings', 'public');
        $this->new_row['image'] = basename(parse_url($image_name, PHP_URL_PATH));
        $this->new_row['type'] = $this->dynamicSettingsKey;
        SiteDynamicSettings::create($this->new_row);
        $this->emit('alert', ['type' => 'success', 'message' => __('message.success_response_message')]);
        $this->reset();
        $this->emit('store_new_row'); // Close model to using to jquery
    }

    public function edit_status($id)
    {
        $row = SiteDynamicSettings::findOrFail($id);
        $this->edit_row = [
            'id' => $row->id,
            'title' => $row->title,
            'active' => $row->active,
        ];
    }
    public function edit($id)
    {
        $row = SiteDynamicSettings::findOrFail($id);
        $this->edit_row = [
            'id' => $row->id,
            'title' => $row->title,
            'description' => $row->description,
            'image' => $row->image,
            'active' => $row->active,
        ];
    }

    public function update_status()
    {
        $this->validate([
            'edit_row.active' => "required|in:" . implode(',', $this->status),
        ]);
        SiteDynamicSettings::findOrFail($this->edit_row['id'])->update([
            'active' => $this->edit_row['active'],
        ]);
        $this->emit('alert', ['type' => 'success', 'message' => __('message.success_response_message')]);

        $this->reset();
        $this->emit('row_updated_status'); // Close model to using to jquery
    }

    public function update()
    {
//        $this->validate([
//            'edit_row.title' => ["required", "min:3", "max:255"],
//            'edit_row.description' => ["required", "min:3"],
//            'edit_row.image' => (gettype($this->edit_row['image']) == 'string' ? '' : 'image|max:3000|mimes:jpg,png,jpeg,gif,svg'),
//
//        ]);
        $row = SiteDynamicSettings::findOrFail($this->edit_row['id']);
        if (gettype($this->edit_row['image']) == 'string') {
            unset($this->edit_row['image']);
        }
        if (isset($this->edit_row['image'])) {
            Storage::disk('public')->delete('images/site-settings/' . $row->getAttributes()['image']);
            $image_name = $this->edit_row['image']->store('images/site-settings', 'public');
            $this->edit_row['image'] = basename(parse_url($image_name, PHP_URL_PATH));
        }
        $row->update($this->edit_row);
        $this->emit('alert', ['type' => 'success', 'message' => __('message.success_response_message')]);

        $this->reset();
        $this->emit('row_updated'); // Close model to using to jquery
    }

    public function render()
    {
        $this->setColumns();
        $this->setDynamicSettingsKey();
        $this->setPageTitle();
        $this->status = SiteDynamicSettings::$status;
        $data = SiteDynamicSettings::where('type', $this->dynamicSettingsKey)->use_search_or_where($this->search, [
            'title' => [
                'is_trans' => true,
                'all_lang' => false,
            ],
        ])
            ->orderBy('id', 'desc')->paginate($this->rows);
        return view('livewire.admin.site-settings.base-dynamic-settings', compact('data'));
    }

    public function columnsHas($column_name):bool
    {
        return in_array($column_name, $this->columns);
    }

    /**
     * @param string[] $columns
     */
    abstract protected function setColumns(): void;


    /**
     * @param int $dynamicSettingsKey
     */
    abstract protected function setDynamicSettingsKey(): void;

    /**
     * @param string $pageTitle
     */
    abstract protected function setPageTitle(): void;
}
