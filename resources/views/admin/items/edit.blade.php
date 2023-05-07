<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh]">
    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <header class="bg-sky-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-6">
                    <p class="text-white text-xl text-center">投稿商品-編集画面</p>
                </div>
            </div>
        </header>

        <main class="grow grid place-items-center">
            <div class="w-full mx-auto px-4 sm:px-6">
                <div class="py-[100px]">
                    <form action="/admin/items/{{ $item->id }}" method="post" class="mt-10" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="flex flex-col items-center">
                            <div class="mb-4">
                                <label for="image">画像ファイル:</label>
                                <input type="file" name="image" id="image" value="{{ $item->image }}" onchange="previewImage(event)">
                                <img id="preview-image" src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->image }}" width="100">
                            </div>

                            <label class="w-full max-w-3xl mx-auto">
                                <div>商品名:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="text" name="item_name" value="{{ $item->item_name }}" />
                                @error('item_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>
                            <label class="w-full max-w-3xl mx-auto">
                                <div>販売価格:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="number" name="seal_price" value="{{ $item->seal_price }}" />
                                @error('seal_price')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>
                            <div class="mt-8 w-full flex items-center justify-center gap-10">

                                <button type="submit" class="p-4 bg-sky-800 text-white w-full max-w-xs hover:bg-sky-900 transition-colors">
                                    更新
                                </button>
                            </div>
                        </div>

                    </form>


                    <div class="mt-8 w-full flex items-center justify-center gap-10">
                        <a href="/admin/items" class="block shrink-0 bg-sky-500 text-white px-6 py-2 rounded-md hover:bg-sky-800 transition-colors duration-300">
                            戻る
                        </a>
                    </div>


                </div>
            </div>
        </main>
        <footer class="bg-sky-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-4 text-center">
                    <p class="text-white text-sm">管理者用編集画面</p>
                </div>
            </div>
        </footer>
</body>

</html></x-admin-layout>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('preview-image');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>