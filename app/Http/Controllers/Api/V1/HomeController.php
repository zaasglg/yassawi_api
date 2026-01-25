<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\LifeSection;
use App\Models\Quote;

class HomeController extends Controller
{
    public function index()
    {
        $locale = request()->header('Accept-Language', 'kz');

        $quotes = Quote::query()
            ->where('is_active', true)
            ->with('translations')
            ->get()
            ->map(function ($quote) use ($locale) {
                return [
                    'id' => $quote->id,
                    'text' => $quote->getTranslation('text', $locale),
                    'is_active' => $quote->is_active,
                ];
            });

        $lifeSections = LifeSection::query()
            ->orderBy('order')
            ->with('translations')
            ->get()
            ->map(function ($section) use ($locale) {
                return [
                    'id' => $section->id,
                    'slug' => $section->slug,
                    'title' => $section->getTranslation('title', $locale),
                    'content' => $section->getTranslation('content', $locale),
                    'image' => $section->image,
                    'order' => $section->order,
                ];
            });

        return response()->json([
            'quotes' => $quotes,
            'life_sections' => $lifeSections,
        ]);
    }
}
