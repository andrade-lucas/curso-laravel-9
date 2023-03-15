<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function index(): View
    {
        return view('post.index', [
            'posts' => Post::query()->get()
        ]);
    }

    public function create(int $userId): View
    {
        return view('post.create', [
            'user' => User::query()->find($userId)
        ]);
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Post::query()->create([
            'user_id' => $data['userId'],
            ...$data
        ]);
        
        return redirect(route('posts.index'));
    }

    public function edit(int $id): View
    {
        return view('post.edit', [
            'post' => Post::query()->find($id)
        ]);
    }

    public function update(int $id, Request $request): RedirectResponse
    {
        return redirect(route('posts.index'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $post = Post::query()->find($id);

        $post->delete();

        return redirect(route('posts.index'));
    }
}
