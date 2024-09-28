<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Article;
use App\Models\Thread;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->query('search');

        $users = User::select('id', 'fullname', 'username')
            ->where("fullname", "like", "%$search%")
            ->orWhere("username", "like", "%$search%")
            ->paginate(10);

        $articles = Article::select('id', 'title', 'slug')
            ->where("title", "like", "%$search%")
            ->orWhere("slug", "like", "%$search%")
            ->without('user', 'articleComments', 'articleLikes') 
            ->paginate(10);

        $threads = Thread::select('id', 'title', 'slug')
            ->where("title", "like", "%$search%")
            ->orWhere("slug", "like", "%$search%")
            ->without('user', 'threadComments', 'threadLikes') 
            ->paginate(10);

        return ResponseHelper::success(
            message: "Success",
            data: [
               'users' => [
                    'data' => $users->items(),
                    'total' => $users->total(),
                ],
                'articles' => [
                    'data' => $articles->items(),
                    'total' => $articles->total(),
                ],
                'threads' => [
                    'data' => $threads->items(),
                    'total' => $threads->total(),
                ],
            ]
        );
    }
}
