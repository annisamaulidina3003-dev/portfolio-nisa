@php($project = $project ?? null)

<div>
    <label for="title" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Judul Project</label>
    <input type="text" id="title" name="title" value="{{ old('title', $project->title ?? '') }}"
        placeholder="Masukkan judul project..." required
        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
    @error('title')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Deskripsi</label>
    <textarea id="description" name="description" rows="5" placeholder="Tulis deskripsi project..."
        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="image" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Gambar Project</label>
    <input type="file" id="image" name="image" accept="image/*" @if (!$project) required @endif
        class="w-full rounded-2xl border border-stone-200 bg-white p-2.5 text-sm text-stone-600 file:mr-3 file:rounded-xl file:border-0 file:bg-emerald-600 file:px-4 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-emerald-700 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-300" />
    <p class="mt-1.5 text-xs text-stone-500 dark:text-stone-400">
        Format JPG, PNG, atau WEBP. Maksimal 4 MB.
        @if ($project)
            Kosongkan jika tidak ingin mengganti gambar.
        @endif
    </p>
    @error('image')
        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
    @enderror
</div>

@if ($project?->image_data_url)
    <div>
        <p class="mb-2 text-sm font-bold text-stone-700 dark:text-stone-200">Gambar saat ini</p>
        <img src="{{ $project->image_data_url }}" alt="{{ $project->title }}"
            class="h-48 w-full rounded-2xl border border-stone-200 object-cover dark:border-stone-700" />
    </div>
@endif
