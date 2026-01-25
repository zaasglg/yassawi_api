<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\LifeSection;

class LifeController extends Controller
{
    public function index()
    {
        $locale = request()->header("Accept-Language", "kz");

        $sections = LifeSection::query()
            ->with("translations")
            ->get()
            ->map(function ($section) use ($locale) {
                return [
                    "id" => $section->id,
                    "slug" => $section->slug,
                    "title" => $section->getTranslation("title", $locale),
                    "content" => $section->getTranslation("content", $locale),
                    "image" => $section->image
                        ? asset("storage/" . $section->image)
                        : null,
                    "order" => $section->order,
                ];
            });

        return response()->json($sections);
    }

    public function show(string $slug)
    {
        $locale = request()->header("Accept-Language", "kz");
        $section = LifeSection::query()
            ->where("slug", $slug)
            ->with("translations")
            ->firstOrFail();

        return response()->json([
            "id" => $section->id,
            "slug" => $section->slug,
            "title" => $section->getTranslation("title", $locale),
            "content" => $section->getTranslation("content", $locale),
            "image" => $section->image
                ? asset("storage/" . $section->image)
                : null,
            "order" => $section->order,
        ]);
    }
}
