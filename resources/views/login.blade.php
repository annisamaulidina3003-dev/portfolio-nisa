<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - PortofolioAnnisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-text { background: linear-gradient(to right, #10b981, #14b8a6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>

<body class="min-h-screen bg-stone-50 flex items-center justify-center p-6">

    <div class="w-full max-w-md">

        <div class="text-center mb-10">
            <a href="/" class="text-3xl font-black gradient-text">PortofolioAnnisa</a>
            <p class="text-stone-600 mt-2">Silakan login untuk mengelola project</p>
        </div>

        <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-stone-100">

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 px-5 py-3 rounded-2xl mb-6 text-sm font-semibold">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block mb-2 font-semibold text-stone-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                        class="w-full h-14 px-5 rounded-2xl border border-stone-200 focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500" />
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-stone-700">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password"
                        class="w-full h-14 px-5 rounded-2xl border border-stone-200 focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500" />
                </div>

                <button type="submit"
                    class="w-full h-14 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:scale-[1.01] transition text-white font-bold text-lg shadow-lg shadow-emerald-200">
                    Login
                </button>
            </form>

        </div>

    </div>

</body>

</html>