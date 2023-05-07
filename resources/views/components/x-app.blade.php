<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- head要素の内容 -->
</head>

<body class="flex flex-col min-h-screen">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">投稿一覧</p>
            </div>
        </div>
    </header>
    <div class="flex-grow">
        {{ $slot }}
    </div>
</body>

</html>