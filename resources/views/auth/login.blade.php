<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFDFC]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaskMate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/TaskMate.svg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-[#1b1b18]">
    <div class="flex min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo with SVG -->
            <div class="flex items-center justify-center gap-3 mb-2">
                <img src="{{ asset('assets/TaskMate.svg') }}" alt="TaskMate Logo" class="h-12 w-12">
                <h2 class="text-3xl font-black tracking-tight uppercase">
                    <span class="text-gray-900">TASK</span><span class="text-blue-600">MATE</span>
                </h2>
            </div>
            <p class="mt-2 text-center text-sm text-gray-500 font-medium">
                Selamat datang kembali! Silakan masuk.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="bg-white px-6 py-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#19140015] sm:rounded-2xl sm:px-10">

                @if (session('success'))
                    <div
                        class="mb-6 p-3 rounded-lg bg-green-50 border border-green-100 text-sm text-green-600 font-medium text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <div class="mt-1.5">
                            <input id="email" name="email" type="email" required placeholder="nama@email.com"
                                class="block w-full rounded-xl border border-[#19140035] bg-white px-4 py-2.5 text-sm shadow-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-600/10 focus:border-blue-600">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <div class="mt-1.5">
                            <input id="password" name="password" type="password" required placeholder="••••••••"
                                class="block w-full rounded-xl border border-[#19140035] bg-white px-4 py-2.5 text-sm shadow-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-600/10 focus:border-blue-600">
                        </div>
                    </div>

                    <div class="pt-2 flex flex-col gap-4">
                        <button type="submit"
                            class="flex w-full justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all active:scale-[0.98]">
                            Masuk Ke Akun
                        </button>

                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-[#19140010]"></div>
                            </div>
                            <div class="relative flex justify-center text-xs uppercase"><span
                                    class="bg-white px-3 text-gray-400 font-medium">Belum punya akun?</span></div>
                        </div>

                        <a href="{{ route('register') }}"
                            class="flex w-full justify-center rounded-xl border border-[#19140035] px-4 py-3 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all active:scale-[0.98]">
                            Daftar TaskMate
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
