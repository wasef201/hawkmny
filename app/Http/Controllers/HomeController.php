<?php

namespace App\Http\Controllers;
use App\Models\Standard;
use App\Models\User;
use App\Models\City;
use Carbon\Carbon;
use App\Models\QuestionComment;
use App\Models\Review;
use DB;
use Jenssegers\Date\Date;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Auth;
class HomeController extends Controller
{
    final public function index()
    {
        if(auth()->user()->type !== 'admin') {
            return $this->dashboard();
        }
        Carbon::setLocale('ar');
        $count = User::where('type' , User::ASSOCIATION )->selectRaw('COUNT(*) as count, MONTH(created_at) month')->whereYear('created_at' , now()->year )
        ->groupBy('month')
        ->get();
        $supervisors_count = User::where('type' , User::SUPERVISOR )->selectRaw('COUNT(*) as count, MONTH(created_at) month')
        ->whereYear('created_at' , now()->year )
        ->groupBy('month')
        ->get();
        $months = [];
        $counts = [];
        $supervisors_months = [];
        $supervisors_counts = [];
        foreach ($count->pluck('month') as $one) {
            $months[] = Date::create()->month($one)->format('F');
        }

        foreach ($count->pluck('count') as $value) {
            $counts[] = $value;
        }
        foreach ($supervisors_count->pluck('month') as $one) {
            $supervisors_months[] = Date::create()->month($one)->format('F');
        }

        foreach ($supervisors_count->pluck('count') as $value) {
            $supervisors_counts[] = $value;
        }

        $associations_sections_info = User::where('type' , User::ASSOCIATION )
        ->select('section', DB::raw('count(*) as total'))
        ->groupBy('section')
        ->get();

        $supervisors_sections_info = User::where('type' , User::SUPERVISOR )
        ->select('section', DB::raw('count(*) as total'))
        ->groupBy('section')
        ->get();

        $associations_areas_info = User::where('users.type' , User::ASSOCIATION )
        ->leftJoin('cities', 'users.area_id', '=', 'cities.id')
        ->select('area_id', DB::raw('count(*) as total'))
        ->groupBy('users.area_id')
        ->get();

        $supervisors_areas_info = User::where('users.type' , User::SUPERVISOR )
        ->leftJoin('cities', 'users.area_id', '=', 'cities.id')
        ->select('area_id', DB::raw('count(*) as total'))
        ->groupBy('users.area_id')
        ->get();

        $sections = [];
        $total_section_association = [];
        foreach ($associations_sections_info->pluck('section') as $section) {
            $sections[] = User::SECTIONS[$section];
        }
        foreach ($associations_sections_info->pluck('total') as $total) {
            $total_section_association[] = $total;
        }

        $supervisor_sections = [];
        $total_section_supervisors = [];

        #TODO exclude admin (admin does not has scopes)

        foreach ($supervisors_sections_info->pluck('section') as $section)
        {
            $supervisor_sections[] = data_get(User::SECTIONS, $section);
        }


        foreach ($supervisors_sections_info->pluck('total') as $total) {
            $total_section_supervisors[] = $total;
        }


        $areas = [];
        $total_area_associations = [];

        foreach ($associations_areas_info->pluck('area_id') as $area_id) {
            $areas[] = City::find($area_id)->name;
        }

        foreach ($associations_areas_info->pluck('total') as $total) {
            $total_area_associations[] = $total;
        }

        $supervisors_areas = [];
        $total_area_supervisors = [];

        foreach ($supervisors_areas_info->pluck('area_id') as $area_id) {
            $supervisors_areas[] = City::find($area_id)->name;
        }

        foreach ($supervisors_areas_info->pluck('total') as $total) {
            $total_area_supervisors[] = $total;
        }

        $un_approved_associations = User::where('type' , User::ASSOCIATION )
        ->where('approved' , 0)
        ->latest()
        ->get();



        return view('pages.index' ,
            compact(
                'counts' ,
                'sections' ,
                'total_section_association' ,
                'supervisors_months' ,
                'supervisors_counts' ,
                'months' ,
                'count' ,
                'supervisor_sections' ,
                'total_section_supervisors' ,
                'areas' ,
                'total_area_associations' ,
                'supervisors_areas' ,
                'total_area_supervisors' ,
                'un_approved_associations'
            )
        );
    }

    final public function dashboard()
    {
        $user = Auth::user();
        if ($user->type == User::ASSOCIATION) {
            $association = Auth::user();
            $association->load([ 'reviews'  , 'reviews.answers' ]);

            $completed_reviews = Review::where([
                ['user_id' , '=' , $association->id ],
                ['status' , '=' , Review::COMPLETED ],
            ])->get();

            $comments = QuestionComment::with('user')->whereIn('review_id' , $association->reviews->pluck('id')->toArray() )->where('content' , '!=' , null )->whereNotIn('user_id' , [Auth::id()] )->latest()->take(10)->get();

            $last_in_progress_review = Review::where([
                ['user_id' , '=' , $association->id ],
                ['status' , '=' , Review::IN_PROGRESS ],
            ])->latest()->first();

            $firstStandard =
            $last_in_progress_review ? $last_in_progress_review->standards()->latest()->first()->standard_id
            :  Standard::query()->first()->id;

            if ($last_in_progress_review) {
                $howkma_meter  = $last_in_progress_review->governance_meter() ;
            } else {
                $howkma_meter = 0;
            }

            return view('pages.dashboard' , compact('comments' , 'howkma_meter' , 'completed_reviews'  , 'last_in_progress_review' ,'firstStandard') );

        } else if($user->type == User::SUPERVISOR) {

            $associations = User::query()
            ->with('area', 'city')
            ->where('type', User::ASSOCIATION);
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

            $associations = $associations->latest()->take(10)->get();
            $my_comments_count = QuestionComment::where('user_id' , Auth::id())->count();
            $my_reviews_which_i_comment_for_count = QuestionComment::where('user_id' , Auth::id())->groupBy('review_id')->count();
            $associations_count = $associations->count();
            $my_last_10_comments = QuestionComment::with(['question' , 'review'])->where('user_id' , Auth::id() )->where('content' , '!=' ,null )->latest()->take(10)->get();


            return view('pages.dashboard' , compact(
                'associations' ,
                'my_comments_count'  ,
                'my_reviews_which_i_comment_for_count' ,
                'associations_count' ,
                'my_last_10_comments'
            ) );
        }
    }
}
