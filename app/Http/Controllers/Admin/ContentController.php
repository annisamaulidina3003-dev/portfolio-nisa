<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function edit(): View
    {
        $education = $this->toLines(config('portfolio.education', []), ['period', 'school', 'description']);
        $experiences = $this->toLines(config('portfolio.experiences', []), ['period', 'title', 'place', 'description']);
        $hardSkills = $this->toLines(config('portfolio.hard_skills', []), ['name', 'level']);
        $softSkills = $this->toLines(config('portfolio.soft_skills', []), ['name', 'level']);

        return view('admin.content', [
            'cvSummary' => config('portfolio.cv_summary'),
            'education' => $education,
            'experiences' => $experiences,
            'hardSkills' => $hardSkills,
            'softSkills' => $softSkills,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cv_summary' => ['nullable', 'string', 'max:2000'],
            'education' => ['nullable', 'string'],
            'experiences' => ['nullable', 'string'],
            'hard_skills' => ['nullable', 'string'],
            'soft_skills' => ['nullable', 'string'],
        ]);

        Setting::setValue('cv_summary', $validated['cv_summary'] ?? '');
        Setting::setValue(
            'education',
            $this->fromLines($validated['education'] ?? '', ['period', 'school', 'description'])
        );
        Setting::setValue(
            'experiences',
            $this->fromLines($validated['experiences'] ?? '', ['period', 'title', 'place', 'description'])
        );
        Setting::setValue('hard_skills', $this->skills($validated['hard_skills'] ?? ''));
        Setting::setValue('soft_skills', $this->skills($validated['soft_skills'] ?? ''));

        return redirect()
            ->route('admin.content.edit')
            ->with('success', 'Konten berhasil diperbarui.');
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @param  array<int, string>  $keys
     */
    private function toLines(array $items, array $keys): string
    {
        return collect($items)
            ->map(fn (array $item) => collect($keys)
                ->map(fn (string $key) => (string) ($item[$key] ?? ''))
                ->implode(' | '))
            ->implode("\n");
    }

    /**
     * @param  array<int, string>  $keys
     * @return array<int, array<string, string>>
     */
    private function fromLines(string $value, array $keys): array
    {
        $columns = count($keys);

        return collect(preg_split('/\r\n|\r|\n/', $value) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->map(function (string $line) use ($columns, $keys) {
                $parts = array_map('trim', explode('|', $line, $columns));
                $parts = array_pad($parts, $columns, '');

                return array_combine($keys, array_slice($parts, 0, $columns));
            })
            ->values()
            ->all();
    }

    /**
     * @return array<int, array{name: string, level: int}>
     */
    private function skills(string $value): array
    {
        return collect($this->fromLines($value, ['name', 'level']))
            ->filter(fn (array $skill) => $skill['name'] !== '')
            ->map(fn (array $skill) => [
                'name' => $skill['name'],
                'level' => max(0, min(100, (int) preg_replace('/\D/', '', $skill['level']))),
            ])
            ->values()
            ->all();
    }
}
