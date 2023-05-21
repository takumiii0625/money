<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>経費一覧</title>
    <link rel="stylesheet" href="/css/costsstyle.css">
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
                    <p class="text-white text-xl text-center">経費一覧</p>
                </div>
            </div>
        </header>

        <main class="grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-[100px]">
                    <p class="text-2xl font-bold text-center">経費登録</p>
                    <form action="/costs" method="post" class="mt-10">
                        @csrf

                        <div class="flex flex-col items-center">

                            <label class="w-full max-w-3xl mx-auto">

                                <select name="item_id" id="itemSelect">
                                    <option value="">-- 商品名 --</option>
                                    @foreach($itemsWithoutCost as $item)
                                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->item_name }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('item_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror



                            </label>
                            <label class="w-full max-w-3xl mx-auto">
                                <div>雑費:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="100" type="number" name="others_cost" value="{{ old('others_cost') }}" />
                                @error('others_cost')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>

                            <label class="w-full max-w-3xl mx-auto">
                                <div>送料:</div>
                                <div class="relative">
                                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 pr-8 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="100" type="number" name="send_cost" value="{{ old('send_cost') }}" />
                                </div>
                                @error('send_cost')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>



                            <label class="w-full max-w-3xl mx-auto">
                                <div>原価:
                                </div>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="100" type="number" name="original_cost" value="{{ old('original_cost') }}" />
                                @error('original_cost')
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
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="10" type="number" name="number" value="{{ old('number') }}" />
                                @error('original_cost')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                            </label>



                            <input type="hidden" name="item_id" id="hiddenItemId" value="">
                            <input type="hidden" name="item_name" id="hiddenItemName" value="">




                            <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                                経費を登録する
                            </button>
                        </div>

                    </form>
                    <div class="mt-8 w-full flex items-center justify-center gap-10">
                        <a href="/dashboard" class="block shrink-0 bg-sky-500 text-white px-6 py-2 rounded-md hover:bg-sky-800 transition-colors duration-300">
                            戻る
                        </a>
                    </div>


                    <br>
                    <script>
                        document.getElementById('itemSelect').addEventListener('change', function() {
                            // 選択されたオプションを取得
                            const selectedOption = this.options[this.selectedIndex];

                            // item_idとitem_nameを取得
                            const itemId = selectedOption.value;
                            const itemName = selectedOption.textContent;

                            // 隠しフォームフィールドにitem_idとitem_nameを設定
                            document.getElementById('hiddenItemId').value = itemId;
                            document.getElementById('hiddenItemName').value = itemName;
                        });
                    </script>
                    <br>
                    <br>
                    <div class="total-expenses-container">
                        <div class="total-expenses-label">経費の合計額</div>
                        <div class="total-expenses-value">{{ $totalExpenses }}円</div>
                    </div>

                    {{-- 追記 --}}
                    @if ($costs->isNotEmpty())
                    <div class="max-w-7xl mx-auto mt-20">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                商品ID</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                商品名</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                雑費</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                送料</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                原価</th>

                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                販売価格</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                個数</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                利益率</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                経費</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                登録日</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($costs as $item)
                                        <tr>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--商品ID-->
                                                    {{ $item->item_id }}
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!-- 商品名：-->
                                                    {{ $item->item_name }}
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--雑費：-->
                                                    {{ $item->others_cost }}円
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--送料：-->
                                                    {{ $item->send_cost }}円
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--原価：-->
                                                    {{ $item->original_cost }}円
                                                </div>
                                            </td>





                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--販売価格：-->
                                                    {{ $item->item->seal_price }}円
                                                </div>
                                            </td>

                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--個数：-->
                                                    {{ $item->number }}個
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--    利益率：-->

                                                    @if ($item->item && ($item->others_cost + $item->send_cost + $item->original_cost) > 0)
                                                    {{ number_format((($item->item->seal_price-($item->others_cost + $item->send_cost + $item->original_cost)) / ($item->item->seal_price)) * 100) }}%
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--経費： -->
                                                    {{ $item->all_cost }}円
                                                </div>
                                            </td>

                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div><!--登録日-->
                                                    {{ $item->created_at }}
                                                </div>
                                            </td>
                                            <td class="p-0 text-right text-sm font-medium">
                                                <div class="flex ">
                                                    <!--
                                                <div>
                                                    <form action="/costs/{{ $item->id }}" method="post" class="inline-block text-gray-500 font-medium" role="menuitem" tabindex="-1">
                                                        @csrf
                                                        @method('PUT')

                                                        {{-- 追記 --}}
                                                        <input type="hidden" name="deleted" value="{{$item->deleted}}">
                                                        {{-- 追記 --}}

                                                        <button type="submit" class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerald-800 transition-colors" onclick="return confirm('本当に削除しますか？')">大削除</button>
                                                    </form>
                                                </div>
                -->
                                                    <div>
                                                        <a href="/costs/{{ $item->id }}/edit/" class="inline-block text-center py-2 px-4 underline underline-offset-2 text-sky-600 bg-white rounded-md border border-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                                                    </div>
                                                    <!--
                                                <div>
                                                    <form action="/costs/{{ $item->id }}" method="post" class="inline-block text-gray-500 font-medium" role="menuitem" tabindex="-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除</button>
                                                    </form>
                                                </div>
                                                -->
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








                </div>
            </div>
        </main>
        <footer class="bg-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-4 text-center">
                    <p class="text-white text-sm">経費登録</p>
                </div>
            </div>
        </footer>
</body>

</html></x-app-layout>