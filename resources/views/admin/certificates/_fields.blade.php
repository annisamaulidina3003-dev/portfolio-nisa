@php($certificate = $certificate ?? null)

<div>
    <label for="title" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Judul Sertifikat</label>
    <input type="text" id="title" name="title" value="{{ old('title', $certificate->title ?? '') }}"
        placeholder="Contoh: Sertifikat Praktik Kerja Lapangan" required
        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
    @error('title')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label for="issuer" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Penerbit</label>
        <input type="text" id="issuer" name="issuer" value="{{ old('issuer', $certificate->issuer ?? '') }}"
            placeholder="Nama instansi / penyelenggara"
            class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
        @error('issuer')
            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="year" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Tahun</label>
        <input type="text" id="year" name="year" value="{{ old('year', $certificate->year ?? '') }}"
            placeholder="Contoh: 2025"
            class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
        @error('year')
            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label for="icon" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Ikon</label>
    <select id="icon" name="icon" required
        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm font-semibold text-stone-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-200">
        <option value="badge" @selected(old('icon', $certificate->icon ?? 'badge') === 'badge')>Badge — Sertifikasi</option>
        <option value="briefcase" @selected(old('icon', $certificate->icon ?? 'badge') === 'briefcase')>Briefcase — Pengalaman Kerja</option>
        <option value="trophy" @selected(old('icon', $certificate->icon ?? 'badge') === 'trophy')>Trophy — Prestasi / Lomba</option>
    </select>
    @error('icon')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Deskripsi</label>
    <textarea id="description" name="description" rows="4" placeholder="Deskripsi singkat sertifikat..."
        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('description', $certificate->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="image" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Gambar Sertifikat</label>
    <input type="file" id="image" name="image" accept="image/*"
        class="w-full rounded-2xl border border-stone-200 bg-white p-2.5 text-sm text-stone-600 file:mr-3 file:rounded-xl file:border-0 file:bg-emerald-600 file:px-4 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-emerald-700 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-300" />
    <p class="mt-1.5 text-xs text-stone-500 dark:text-stone-400">
        Opsional. Format JPG, PNG, atau WEBP. Maksimal 4 MB.
        @if ($certificate)
            Kosongkan jika tidak ingin mengganti gambar.
        @endif
    </p>
    @error('image')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

@if ($certificate?->image && file_exists(public_path($certificate->image)))
    <div>
        <p class="mb-2 text-sm font-bold text-stone-700 dark:text-stone-200">Gambar saat ini</p>
        <img src="{{ asset($certificate->image) }}" alt="{{ $certificate->title }}"
            class="h-48 w-full rounded-2xl border border-stone-200 object-cover dark:border-stone-700" />
    </div>
@endif
