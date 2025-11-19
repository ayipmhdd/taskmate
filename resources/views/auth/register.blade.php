<!DOCTYPE html>
<html>

<head>
    <title>Register - TaskMate</title>
</head>

<body>
    <h2>Register TaskMate</h2>

    @if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}"><br>
        @error('name')
        <small style="color:red">{{ $message }}</small>
        @enderror <br>

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br>
        @error('email')
        <small style="color:red">{{ $message }}</small>
        @enderror <br>

        <input type="password" name="password" placeholder="Password"><br>
        @error('password')
        <small style="color:red">{{ $message }}</small>
        @enderror <br>

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"><br>

        <button type="submit">Daftar</button>

        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
            Log in
        </a>
    </form>
</body>

</html>
