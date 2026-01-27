<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFDFC]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskMate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/TaskMate.svg') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                Mulai kelola tugasmu dengan lebih rapi
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="bg-white px-6 py-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#19140015] sm:rounded-2xl sm:px-10">

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <div class="mt-1.5">
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                placeholder="Siapa namamu?"
                                class="block w-full rounded-xl border @error('name') border-red-400 @else border-[#19140035] @enderror bg-white px-4 py-2.5 text-sm shadow-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-600/10 focus:border-blue-600">
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-red-500 italic font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                        <div class="mt-1.5">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                placeholder="nama@email.com"
                                class="block w-full rounded-xl border @error('email') border-red-400 @else border-[#19140035] @enderror bg-white px-4 py-2.5 text-sm shadow-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-600/10 focus:border-blue-600">
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500 italic font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="mt-1.5">
                                <input id="password" name="password" type="password" required placeholder="••••••••"
                                    class="block w-full rounded-xl border @error('password') border-red-400 @else border-[#19140035] @enderror bg-white px-4 py-2.5 text-sm shadow-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-600/10 focus:border-blue-600">
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-gray-700">Konfirmasi</label>
                            <div class="mt-1.5">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    placeholder="••••••••"
                                    class="block w-full rounded-xl border border-[#19140035] bg-white px-4 py-2.5 text-sm shadow-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-600/10 focus:border-blue-600">
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 italic font-medium">{{ $message }}</p>
                    @enderror

                    <div class="pt-4 flex flex-col gap-4">
                        <button type="submit"
                            class="flex w-full justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all active:scale-[0.98]">
                            Daftar Sekarang
                        </button>

                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-[#19140010]"></div>
                            </div>
                            <div class="relative flex justify-center text-xs uppercase"><span
                                    class="bg-white px-3 text-gray-400 font-medium">Sudah punya akun?</span></div>
                        </div>

                        <a href="{{ route('login') }}"
                            class="flex w-full justify-center rounded-xl border border-[#19140035] px-4 py-3 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all active:scale-[0.98]">
                            Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
