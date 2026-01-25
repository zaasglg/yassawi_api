<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index()
    {
        $locale = request()->header('Accept-Language', 'kz');

        $tests = Test::query()
            ->where('is_active', true)
            ->with('translations')
            ->get()
            ->map(function ($test) use ($locale) {
                return [
                    'id' => $test->id,
                    'title' => $test->getTranslation('title', $locale),
                    'is_active' => $test->is_active,
                ];
            });

        return response()->json($tests);
    }

    public function show(int $id)
    {
        $locale = request()->header('Accept-Language', 'kz');
        $test = Test::query()->with(['questions.translations', 'translations'])->findOrFail($id);

        return response()->json([
            'id' => $test->id,
            'title' => $test->getTranslation('title', $locale),
            'is_active' => $test->is_active,
            'questions' => $test->questions->map(function ($question) use ($locale) {
                $optionsJson = $question->getTranslation('options', $locale);
                return [
                    'id' => $question->id,
                    'question' => $question->getTranslation('question', $locale),
                    'options' => $optionsJson ? json_decode($optionsJson, true) : [],
                ];
            }),
        ]);
    }

    public function submit(Request $request, int $testId)
    {
        $test = Test::query()->with('questions')->findOrFail($testId);

        \Illuminate\Support\Facades\Gate::authorize('submit', $test);

        $data = $request->validate([
            'answers' => ['required', 'array'],
        ]);

        $answers = $data['answers'];
        $score = $test->questions
            ->filter(fn($question) => array_key_exists($question->id, $answers)
                && (string) $answers[$question->id] === (string) $question->correct_answer)
            ->count();

        $result = TestResult::query()->create([
            'user_id' => $request->user()->id,
            'test_id' => $test->id,
            'score' => $score,
        ]);

        return response()->json($result, 201);
    }
}
