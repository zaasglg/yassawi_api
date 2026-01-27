<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $locale = request()->header('Accept-Language', 'kz');

        $posts = Post::query()
            ->where('is_active', true)
            ->with(['translations', 'user'])
            ->latest()
            ->get()
            ->map(function ($post) use ($locale) {
                return [
                    'id' => $post->id,
                    'title' => $post->getTranslation('title', $locale),
                    'content' => $post->getTranslation('content', $locale),
                    'image' => $post->image_path ? asset('storage/' . $post->image_path) : null,
                    'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                    'user' => [
                        'id' => $post->user->id,
                        'name' => $post->user->name,
                        'avatar' => $post->user->avatar_url,
                    ],
                ];
            });

        return response()->json($posts);
    }

    public function show($id)
    {
        $locale = request()->header('Accept-Language', 'kz');

        $post = Post::query()
            ->where('is_active', true)
            ->where('id', $id)
            ->with(['translations', 'user'])
            ->firstOrFail();

        return response()->json([
            'id' => $post->id,
            'title' => $post->getTranslation('title', $locale),
            'content' => $post->getTranslation('content', $locale),
            'image' => $post->image_path ? asset('storage/' . $post->image_path) : null,
            'created_at' => $post->created_at->format('Y-m-d H:i:s'),
            'user' => [
                'id' => $post->user->id,
                'name' => $post->user->name,
                'avatar' => $post->user->avatar_url,
            ],
        ]);
    }
}
