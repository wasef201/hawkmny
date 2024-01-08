<?php

namespace App\Http\Livewire\Questions;

use Livewire\Component;
use App\Models\Question;
use Illuminate\Support\Collection;
use App\Models\Review;
use App\Models\CommentFile;
use Auth;
use Storage;
use Livewire\WithFileUploads;
use App\Models\QuestionComment as QuestionCommentModel ;
class QuestionComment extends Component
{
    use WithFileUploads;
    public Question $question;
    public Review $review;
    public Collection $comments;
    public $comment = '';
    public $files = null;

    protected $listeners = [  'questionChanged' , 'commentSaved' , 'deleteFile'  , 'fileDeleted' => '$refresh' ];

    public function questionChanged()
    {
        return $this->render();
    }


    public function commentSaved()
    {
        $this->comments = QuestionCommentModel::where([
            ['question_id', '=' ,  $this->question->id]  , 
            ['review_id' , '=' , $this->review->id  ]
        ])->get();
        $this->comment = '';
    }



    public function mount($question , $review)
    {
        $this->question = $question;
        $this->review = $review;
        $this->comments = QuestionCommentModel::where([
            ['question_id', '=' ,  $this->question->id]  , 
            ['review_id' , '=' , $this->review->id  ]
        ])->get();
    }

    public function saveComment()
    {
        $this->validate([

            'files.*' => 'nullable|mimes:xlxs,xlx,doc,docx,pdf,jpg,jpeg,png',
        ]);

        $comment = new QuestionCommentModel;
        $comment->content = $this->comment;
        $comment->user_id = Auth::id();
        $comment->question_id  = $this->question->id;
        $comment->review_id  = $this->review->id;
        $comment->save();
        if ($this->files != null) {
            $uploadedFiles = [];
            foreach ($this->files as $file) {
                $uploadedFiles[] = new CommentFile([
                    'file' => basename($file->store('association_files')) , 
                    'comment_id' => $comment->id , 
                    'file_name' => $file->getClientOriginalName() , 
                ]);
            }
            $comment->files()->saveMany($uploadedFiles);
        }
        $this->emit('commentSaved');
    }


    public function downloaFile(CommentFile $comment_file)
    {
        return response()->download(storage_path('app/public/association_files/'.$comment_file->file) , $comment_file->file_name );
    }



    public function deleteFile($file_id)
    {
        $file = CommentFile::find($file_id);
        if ($file) {
            $file->delete();
            $this->emit('fileDeleted');
        }
    }




    public function render()
    {
        return view('livewire.questions.question-comment');
    }
}
