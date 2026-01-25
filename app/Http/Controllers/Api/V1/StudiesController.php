<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Study;

class StudiesController extends Controller
{
    public function index()
    {
        $locale = request()->header('Accept-Language', 'kz');

        $studies = Study::query()
            ->with('translations')
            ->get()
            ->map(function ($study) use ($locale) {
                return [
                    'id' => $study->id,
                    'type' => $study->type,
                    'title' => $study->getTranslation('title', $locale),
                    'content' => $study->getTranslation('content', $locale),
                ];
            });

        return response()->json($studies);
    }
}
