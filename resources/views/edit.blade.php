<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Project - PortofolioAnnisa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .gradient-text { background: linear-gradient(to right, #10b981, #14b8a6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>

<body class="min-h-screen bg-stone-50 text-stone-800">

    <header class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-stone-200">
        <div class="max-w-4xl mx-auto px-6 lg:px-10">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}" class="text-3xl font-black gradient-text">PortofolioAnnisa</a>
            </div>
        </div>
    </header>

    <div class="pt-36 pb-24">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-5xl font-black mb-4 text-stone-900">Edit Project</h2>
                <p class="text-stone-600 text-lg">Update judul, gambar, dan deskripsi project.</p>
            </div>
            <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-xl border border-stone-100">
                <form action="{{ route('portofolios.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data" class="space-y-7">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-3 font-semibold">Judul Project</label>
                        <input type="text" name="title" value="{{ old('title', $portofolio->title) }}" placeholder="Masukkan judul project..." class="w-full h-14 px-5 rounded-2xl border border-stone-200 focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500" />
                    </div>

                    <div>
                        <label class="block mb-3 font-semibold">Gambar Project</label>
                        <input type="file" name="image" class="w-full border border-stone-200 rounded-2xl p-4 file:bg-emerald-600 file:text-white file:border-0 file:px-5 file:py-2 file:rounded-xl file:mr-4 hover:file:bg-emerald-700" />
                    </div>

                    @if ($portofolio->image_data_url)
                        <div class="rounded-2xl overflow-hidden border border-stone-200">
                            <img src="{{ $portofolio->image_data_url }}" alt="{{ $portofolio->title }}" class="w-full h-48 object-cover" />
                        </div>
                    @endif

                    <div>
                        <label class="block mb-3 font-semibold">Deskripsi</label>
                        <textarea rows="6" name="description" placeholder="Tulis deskripsi project..." class="w-full p-5 rounded-2xl border border-stone-200 focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500">{{ old('description', $portofolio->description) }}</textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 h-14 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:scale-[1.01] transition text-white font-bold text-lg shadow-lg shadow-emerald-200">Update Project</button>
                        <a href="{{ route('home') }}" class="h-14 px-8 rounded-2xl bg-stone-200 hover:bg-stone-300 transition text-stone-800 font-semibold inline-flex items-center">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>