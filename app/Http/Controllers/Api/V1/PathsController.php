<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Path;

class PathsController extends Controller
{
    public function index()
    {
        $locale = request()->header('Accept-Language', 'kz');

        $paths = Path::query()
            ->with('translations')
            ->get()
            ->map(function ($path) use ($locale) {
                return [
                    'id' => $path->id,
                    'title' => $path->getTranslation('title', $locale),
                    'content' => $path->getTranslation('content', $locale),
                    'coordinates' => $path->coordinates,
                ];
            });

        return response()->json($paths);
    }
}
