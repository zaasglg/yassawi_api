<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Work;

class WorksController extends Controller
{
    public function index()
    {
        $locale = request()->header('Accept-Language', 'kz');

        $works = Work::query()
            ->with('translations')
            ->get()
            ->map(function ($work) use ($locale) {
                return [
                    'id' => $work->id,
                    'title' => $work->getTranslation('title', $locale),
                    'short_description' => $work->getTranslation('short_description', $locale),
                    'main_content' => $work->getTranslation('main_content', $locale),
                    'spiritual_value' => $work->getTranslation('spiritual_value', $locale),
                ];
            });

        return response()->json($works);
    }
}
