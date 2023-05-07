<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cost</title>

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh]">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <header class="bg-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-6">
                    <p class="text-white text-xl text-center">経費-編集画面</p>
                </div>
            </div>
        </header>

        <main class="grow grid place-items-center">
            <div class="w-full mx-auto px-4 sm:px-6">
                <div class="py-[100px]">

                    <div class="mt-8 w-full flex items-center justify-center gap-10">
                        <div>商品名：
                        </div>
                        <p class="text-xl">
                            {{ $cost->item_name }}
                        </p>
                    </div>


                    <form action="/costs/{{ $cost->id }}" method="post" class="mt-10">
                        @csrf
                        @method('PUT')



                        <div class="flex flex-col items-center">
                            <label class="w-full max-w-3xl mx-auto">
                                <div>雑費:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="int" name="others_cost" value="{{ $cost->others_cost }}" />
                                @error('others_cost')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>

                            <label class="w-full max-w-3xl mx-auto">
                                <div>送料:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="text" name="send_cost" value="{{ $cost->send_cost }}" />
                                @error('others_cost')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>

                            <label class="w-full max-w-3xl mx-auto">
                                <div>原価：
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="text" name="original_cost" value="{{ $cost->original_cost }}" />
                                @error('others_cost')
                                <div class="mt-3">

                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>

                            <label class="w-full max-w-3xl mx-auto">
                                <div>個数:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="number" name="number" value="{{ $cost->number }}" />
                                @error('original_cost')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>

                            <div class="mt-8 w-full flex items-center justify-center gap-10">

                                <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                                    更新
                                </button>
                            </div>
                        </div>

                    </form>
                    <div class="mt-8 w-full flex items-center justify-center gap-10">
                        <a href="/costs" class="block shrink-0 bg-sky-500 text-white px-6 py-2 rounded-md hover:bg-sky-800 transition-colors duration-300">
                            戻る
                        </a>
                    </div>



                </div>
            </div>
        </main>
        <footer class="bg-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-4 text-center">
                    <p class="text-white text-sm">Todoアプリ</p>
                </div>
            </div>
        </footer>
</body>

</html></x-app-layout>