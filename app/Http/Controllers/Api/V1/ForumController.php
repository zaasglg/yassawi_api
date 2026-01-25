<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ForumBookmark;
use App\Models\ForumCategory;
use App\Models\ForumLike;
use App\Models\ForumReply;
use App\Models\ForumTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ForumController extends Controller
{
    // GET /categories
    public function categories()
    {
        $categories = ForumCategory::withCount('topics')->get();
        return response()->json($categories);
    }

    // GET /topics
    public function index(Request $request)
    {
        $query = ForumTopic::query()
            ->with(['user:id,name,avatar', 'category:id,name,color_code,slug'])
            ->withCount('replies');

        // Filter by Category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->has('search_query')) {
            $search = $request->search_query;
            $query->where('title', 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                // Most views and likes. Simplified to views for now, or combine.
                // Or use the scope I defined
                $query->popular();
                break;
            case 'hot':
                $query->hot();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $topics = $query->paginate(20);

        // Append relative time
        $topics->getCollection()->transform(function ($topic) {
            $topic->created_at_human = $topic->created_at->diffForHumans();
            return $topic;
        });

        return response()->json($topics);
    }

    // POST /topics
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:forum_categories,id',
        ]);

        $topic = ForumTopic::create([
            'user_id' => Auth::id(),
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return response()->json($topic, 201);
    }

    // GET /topics/{id}
    public function show($id)
    {
        $userId = Auth::id();

        $topic = ForumTopic::with([
            'user',
            'category',
            'bookmarks' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }
        ])
            ->withCount(['replies', 'likes'])
            ->when($userId, function ($query) use ($userId) {
                $query->withExists([
                    'likes as is_liked_by_me' => function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    }
                ]);
            })
            ->findOrFail($id);

        // Increment views
        $topic->increment('views_count');

        $topic->is_bookmarked_by_me = $topic->bookmarks->isNotEmpty();
        $topic->unsetRelation('bookmarks'); // Clean up
        $topic->created_at_human = $topic->created_at->diffForHumans();

        return response()->json($topic);
    }

    // GET /topics/{id}/replies
    public function replies(Request $request, $id)
    {
        $userId = Auth::id();

        $replies = ForumReply::where('topic_id', $id)
            ->with(['user:id,name,avatar', 'replyToUser:id,name'])
            ->withCount('likes')
            ->when($userId, function ($query) use ($userId) {
                $query->withExists([
                    'likes as is_liked_by_me' => function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    }
                ]);
            })
            ->orderBy('created_at', 'asc') // Oldest first usually for forums
            ->paginate(20);

        $replies->getCollection()->transform(function ($reply) {
            $reply->created_at_human = $reply->created_at->diffForHumans();
            return $reply;
        });

        return response()->json($replies);
    }

    // POST /topics/{id}/replies
    public function storeReply(Request $request, $id)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'reply_to_user_id' => 'nullable|exists:users,id',
        ]);

        $reply = ForumReply::create([
            'topic_id' => $id,
            'user_id' => Auth::id(),
            'content' => $data['content'],
            'reply_to_user_id' => $data['reply_to_user_id'] ?? null,
        ]);

        return response()->json($reply, 201);
    }

    // POST /interactions/like
    public function like(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:topic,reply',
        ]);

        $modelClass = $data['type'] === 'topic' ? ForumTopic::class : ForumReply::class;
        $model = $modelClass::findOrFail($data['id']);

        $existingLike = ForumLike::where('user_id', Auth::id())
            ->where('likeable_id', $model->id)
            ->where('likeable_type', $modelClass)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'Unliked']);
        } else {
            ForumLike::create([
                'user_id' => Auth::id(),
                'likeable_id' => $model->id,
                'likeable_type' => $modelClass,
            ]);
            return response()->json(['message' => 'Liked']);
        }
    }

    // POST /interactions/bookmark
    public function bookmark(Request $request)
    {
        $data = $request->validate([
            'topic_id' => 'required|exists:forum_topics,id',
        ]);

        $existing = ForumBookmark::where('user_id', Auth::id())
            ->where('topic_id', $data['topic_id'])
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['message' => 'Unbookmarked']);
        } else {
            ForumBookmark::create([
                'user_id' => Auth::id(),
                'topic_id' => $data['topic_id'],
            ]);
            return response()->json(['message' => 'Bookmarked']);
        }
    }
}
