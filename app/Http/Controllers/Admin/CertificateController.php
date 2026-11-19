<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CertificateController extends Controller
{
    private const ICONS = ['briefcase', 'badge', 'trophy'];

    public function index(): View
    {
        $certificates = Certificate::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(12);

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create(): View
    {
        return view('admin.certificates.create', ['icons' => self::ICONS]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCertificate($request);

        Certificate::create([
            'title' => $validated['title'],
            'issuer' => $validated['issuer'] ?? '',
            'description' => $validated['description'] ?? null,
            'year' => $validated['year'] ?? '',
            'icon' => $validated['icon'],
            'image' => $request->hasFile('image') ? $this->storeImage($request->file('image')) : null,
            'sort_order' => (Certificate::max('sort_order') ?? -1) + 1,
        ]);

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function edit(Certificate $certificate): View
    {
        return view('admin.certificates.edit', [
            'certificate' => $certificate,
            'icons' => self::ICONS,
        ]);
    }

    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $validated = $this->validateCertificate($request);

        $certificate->title = $validated['title'];
        $certificate->issuer = $validated['issuer'] ?? '';
        $certificate->description = $validated['description'] ?? null;
        $certificate->year = $validated['year'] ?? '';
        $certificate->icon = $validated['icon'];

        if ($request->hasFile('image')) {
            $this->deleteImage($certificate->image);
            $certificate->image = $this->storeImage($request->file('image'));
        }

        $certificate->save();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $this->deleteImage($certificate->image);
        $certificate->delete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil dihapus.');
    }

    /**
     * @return array{title: string, issuer: ?string, description: ?string, year: ?string, icon: string}
     */
    private function validateCertificate(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'year' => ['nullable', 'string', 'max:20'],
            'icon' => ['required', 'string', 'in:'.implode(',', self::ICONS)],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
        ]);
    }

    private function storeImage(UploadedFile $file): string
    {
        $directory = public_path('image/certificates');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            .'-'.Str::random(8).'.'.$file->extension();

        $file->move($directory, $filename);

        return 'image/certificates/'.$filename;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Str::startsWith($path, 'image/certificates/')) {
            File::delete(public_path($path));
        }
    }
}
