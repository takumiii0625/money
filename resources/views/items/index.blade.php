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
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <header class="bg-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-6">
                    <p class="text-white text-xl text-center">投稿一覧</p>
                </div>
            </div>

        </header>

        <main class="grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-[100px]">
                    <p class="text-2xl font-bold text-center">商品の登録</p>

                    <form action="/items" method="post" class="mt-10" enctype="multipart/form-data">
                        @csrf

                        <div class="flex flex-col items-center">

                            <div>
                                <label for="image">画像ファイル:</label>
                                <img id="preview-image" src="{{ asset('storage/images/no-image.jpg') }}" alt="画像プレビュー" width="100" style="display:none;">
                                <input type="file" name="image" id="image" onchange="previewImage(event)">
                            </div>

                            <label class="w-full max-w-3xl mx-auto">
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="ポケモンカード" type="text" name="item_name" />
                                @error('item_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>
                            <label class="w-full max-w-3xl mx-auto">
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="10000" type="number" name="seal_price" />
                                @error('seal_price')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>

                            <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                                追加する
                            </button>
                        </div>

                    </form>
                    <div class="mt-8 w-full flex items-center justify-center gap-10">
                        <a href="/dashboard" class="block shrink-0 bg-sky-500 text-white px-6 py-2 rounded-md hover:bg-sky-800 transition-colors duration-300">
                            戻る
                        </a>
                    </div>


                    {{-- 追記 --}}
                    @if ($items->isNotEmpty())
                    <div class="max-w-7xl mx-auto mt-20">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                商品名</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                画像</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                販売価格</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                利益率</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                登録日</th>

                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($items as $item)

                                        <tr>

                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--商品名：-->
                                                    {{ $item->item_name }}
                                                </div>
                                            </td>
                                            <!-- 画像表示を追加 -->
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div>
                                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->image }}" width="100">
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--販売価格：-->
                                                    {{ $item->seal_price }}円
                                                </div>
                                            </td>


                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--利益率：-->

                                                    @if($item->cost)
                                                    {{ number_format((($item->seal_price - ($item->cost->others_cost + $item->cost->send_cost + $item->cost->original_cost)) / ($item->seal_price)) * 100) }}%
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!-- 登録日：-->
                                                    {{ $item->created_at }}
                                                </div>
                                            </td>
                                            <td class="p-0 text-right text-sm font-medium">
                                                <div class="flex  space-x-6">
                                                    <div>
                                                        <form action="/items/{{ $item->id }}" method="post" class="inline-block text-gray-500 font-medium" role="menuitem" tabindex="-1">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="deleted" value="{{$item->deleted}}">
                                                            <button type="submit" class="bg-emerald-700 py-2 px-4 text-white rounded-md md:hover:bg-emerald-800 transition-colors" onclick="return confirm('本当に削除しますか？')">削除</button>
                                                        </form>
                                                    </div>
                                                    <div>
                                                        <a href="/items/{{ $item->id }}/edit/" class="inline-block text-center py-2 px-4 underline underline-offset-2 text-sky-600 bg-white rounded-md border border-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                                                    </div>
                                                    <!--         <div>
                                                        <form action="/items/{{ $item->id }}" method="post" class="inline-block text-gray-500 font-medium" role="menuitem" tabindex="-1">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除</button>
                                                        </form>
                                                    </div>-->
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- 追記ここまで --}}

                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>




                </div>
            </div>
        </main>
        <footer class="bg-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-4 text-center">
                    <p class="text-white text-sm">投稿一覧</p>
                </div>
            </div>
        </footer>
</body>

</html></x-app-layout>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
            output.style.display = 'block'; // 画像プレビューを表示する
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>