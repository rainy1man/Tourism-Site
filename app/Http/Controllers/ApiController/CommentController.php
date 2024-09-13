<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Tour;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->can('see.comment')) {
            $comments = new Comment();

            if ($request->has('filter')) {
                switch ($request->filter) {
                    case 'pending':
                        $comments = $comments->where('visibility', 'pending');
                        break;
                    case 'approved':
                        $comments = $comments->where('visibility', 'approved');
                        break;
                    case 'rejected':
                        $comments = $comments->where('visibility', 'rejected');
                        break;
                }
            }
            $comments = $comments->orderBy('id', 'desc')->paginate(10);

            return CommentResource::collection($comments);

        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function store(Request $request, Tour $tour)
    {
        if (
            $request->user()->whereHas('orders.trip.tour', function ($querry) use ($tour) {
                $querry->where('id', $tour->id);
            }) && $request->user()->whereHas('orders', function ($querry) {
                $querry->where('order_status', 'completed');
            })
        ) {
            $comment = Comment::create([
                'text' => $request->input('text'),
                'user_id' => Auth::id(),
                'tour_id' => $tour->id,
                'score' => $request->input('score'),
                'visibility' => 'pending',
            ]);
            return $this->responseService->success_response($comment);
        } else {
            return $this->responseService->error_response('شما مجاز به کامنت گذاشتن برای این تور نمی باشید');
        }
    }

    public function change_status(Request $request, $id)
    {
        if ($request->user()->can('update.comment')) {
            $comment = Comment::find($id);
            $comment->update(['visibility' => $request->visibility]);
            return $this->responseService->success_response($comment);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete.comment')) {
            $comment = Comment::find($id);
            $comment->delete();
            return $this->responseService->success_response();
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function score(Request $request)
    {
        $average_score = Comment::where('visibility', 'approved')->avg('score');
        return $this->responseService->success_response($average_score);
    }

}
