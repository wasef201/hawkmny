<?php

namespace App\Http\Livewire\Questions;

use App\Http\Livewire\WithResetPage;
use App\Models\Field;
use App\Models\Practice;
use App\Models\Question;
use App\Models\Standard;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionsTable extends Component
{
    use WithPagination, WithResetPage;

    protected string $paginationTheme = 'bootstrap';

    protected static array $resetPageTarget = ['perPage', 'search', 'practice',  'standard', 'field'];

    protected $queryString = ['page' => 1, 'search', 'standard', 'field', 'practice', 'sortBy', 'perPage'];

    public ?int $standard = null;
    public ?int $field = null;
    public ?int $practice = null;
    public int $perPage = 15;

    public ?string $search = null;
    public ?string $sortBy = null;

    public Collection $standards;
    public Collection $fields;
    public ?Collection $practices;
    public array $sorts = [];
    public array $pages = [];

    final public function mount(): void
    {
        $this->standards = Standard::all();
        $this->fields = Field::query()->where('standard_id', $this->standard)->get();
        $this->practices = collect();
        $this->sorts = [
            'choices_count' => 'عدد الاختيارات',
            'degree' => 'الدرجة',
            'latest' => 'الاحدث',
            'oldest' => 'الاقدم',
        ];
        $this->pages = [15, 30, 50, 100, 200];
    }

    public function render()
    {
        return view('pages.question.inc.questions-table', [
            'questions' => Question::query()
                ->with('standard', 'field', 'practice')
                ->withCount('choices')
                ->when($this->standard, fn($q) => $q->whereStandardId($this->standard))
                ->when($this->field, fn($q) => $q->whereFieldId($this->field))
                ->when($this->practice, fn($q) => $q->wherePracticeId($this->practice))
                ->when($this->search, fn($q) => $q->where('name','like', '%'.$this->search.'%'))
                ->when(in_array($this->sortBy,['choices_count','degree'], true),
                    fn($q) => $q->orderByDesc($this->sortBy)
                )->when($this->sortBy === 'latest', fn($q) => $q->latest()
                )->when($this->sortBy === 'oldest', fn($q) => $q->oldest()
                )
                ->paginate($this->perPage)
        ]);
    }

    public function updatingStandard(int $standardId): void
    {
        $this->fields = Field::query()->where('standard_id', $standardId)->get();
        $this->reset('field', 'practice');
        $this->emit('filter:select2:standard:update', $this->fields);
    }

    public function updatingField(int $fieldId): void
    {
        $this->practices = Practice::query()->where('field_id', $fieldId)->get();
        $this->reset('practice');
        $this->emit('filter:select2:field:update', $this->practices);
    }
}
