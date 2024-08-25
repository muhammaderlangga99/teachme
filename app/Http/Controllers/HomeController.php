<?php

namespace App\Http\Controllers;

use App\Http\Enums\GroupUserStatus;
use App\Http\Resources\GroupResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $user = $request->user();
        // ambil post dari user yang di follow
        $posts = Post::postsForTimeline($userId)
            // select dari table posts semua kolom
            ->select('posts.*')
            ->leftJoin('followers AS f', function ($join) use ($userId) {
                $join->on('posts.user_id', '=', 'f.user_id')
                    ->where('f.follower_id', '=', $userId);
            })
            ->leftJoin('group_users AS gu', function ($join) use ($userId) {
                $join->on('gu.group_id', '=', 'posts.group_id')
                    ->where('gu.user_id', '=', $userId)
                    ->where('gu.status', GroupUserStatus::APPROVED->value);
            })
            ->where(function ($query) use ($userId) {
                /** @var \Illuminate\Database\Query\Builder $query */
                $query->whereNotNull('f.follower_id')
                    ->orWhereNotNull('gu.group_id')
                    ->orWhere('posts.user_id', $userId);
            })
            //            ->whereNot('posts.user_id', $userId)

            // paginate 10 post per page
            ->paginate(10);

        // ini untuk mengubah data post menjadi bentuk resource yang sudah di format
        $posts = PostResource::collection($posts);

        if ($request->wantsJson()) {
            return $posts;
        }

        // get 5 groups from oldest to newes
        $groups = Group::query() // query dari database sql
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        // $groups = Group::query()
        // ->with('currentUserGroup')
        // ->select(['groups.*'])
        // ->join('group_users AS gu', 'gu.group_id', 'groups.id')
        // ->where('gu.user_id', Auth::id())
        // ->orderBy('gu.role')
        // ->orderBy('name', 'desc')
        // ->get();

        return Inertia::render('Home', [
            'posts' => $posts,
            'groups' => GroupResource::collection($groups),
            // 'users' => UserResource::collection($user->followers),
            'followings' => UserResource::collection($user->followings)
        ]);
    }
}
