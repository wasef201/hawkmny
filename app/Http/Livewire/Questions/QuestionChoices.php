<?php

namespace App\Http\Livewire\Questions;

use App\Models\Choice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class QuestionChoices extends Component
{

    public Collection $choices;
    public ?string $title = null;
    public ?int $percentage = null;
    public ?int $items = 1;

    protected $listeners = ['delete'];

    protected array $rules = [
        'title' => 'required|string|min:2',
        'percentage' => 'required|numeric',
        'choices.*.name' => 'required|string|min:2',
        'choices.*.percentage' => 'required|numeric',
    ];

    final public function render(): View
    {
        return view('pages.question.inc.choices');
    }

    final public function create(): void
    {
        $this->validate();
        $choice = Choice::query()->create([
            'question_id' => $this->choices->first()->question_id,
            'name' => $this->title,
            'percentage' => $this->percentage,
            'is_active' => true
          ]);
        $this->choices->add($choice);
        $this->reset('title', 'percentage');
    }

    /**
     * @param int $id
     * @return void
     */
    final public function update(int $id): void
    {
        $this->choices->where('id',$id)->first()->save();
        $this->emit('notification', 'تم تحديث الاختيار بنجاح');
    }

    /**
     * @param int $id
     * @return void
     */
    final public function delete(int $id): void
    {
        Choice::destroy($id);
       $this->choices = $this->choices->filter(fn($choice) => $id !== $choice->id);
       $this->emit('notification', 'تم حذف الاختيار بنجاح');
    }
}
