<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Project X PPDB</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-theme-light antialiased text-theme-dark min-h-screen flex flex-col justify-center py-12 px-4">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/" class="flex justify-center items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-xl bg-theme-dark flex items-center justify-center text-theme-light font-bold text-2xl shadow-lg">X</div>
        </a>
        <h2 class="text-center text-3xl font-extrabold text-theme-dark">Masuk ke Akun</h2>
        <p class="text-center text-theme-dark/60 mt-2">Belum punya akun? <a href="{{ route('register') }}" class="text-theme-green font-bold hover:underline">Daftar di sini</a></p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-xl border border-theme-tan/20 rounded-3xl sm:px-10">
            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-xl mb-6 text-sm text-center font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-theme-dark mb-2">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-tan focus:border-theme-tan transition text-sm" placeholder="contoh@email.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-theme-dark mb-2">Password</label>
                    <input id="password" name="password" type="password" required class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-tan focus:border-theme-tan transition text-sm">
                </div>
                <button type="submit" class="w-full py-3 rounded-xl bg-theme-dark text-theme-light font-bold hover:bg-theme-green transition-colors shadow-md">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
