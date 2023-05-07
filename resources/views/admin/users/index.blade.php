<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Costs</title>

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh]">
    <header class="bg-sky-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl text-center">管理者用登録者一覧</p>
            </div>
        </div>
    </header>

    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center">管理者用登録者一覧</p>

                <div class="mt-8 w-full flex items-center justify-center gap-10">
                    <a href="dashboard" class="block shrink-0 bg-sky-500 text-white px-6 py-2 rounded-md hover:bg-sky-800 transition-colors duration-300">
                        戻る
                    </a>
                </div>

                {{-- 追記 --}}
                @if ($users->isNotEmpty())
                <div class="max-w-7xl mx-auto mt-20">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            一般ユーザーID</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            一般ユーザー名</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            経費の合計額</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            登録日</th>

                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--ユーザーID-->
                                                {{ $user->id }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--ユーザー名-->
                                                {{ $user->firstWhere('id', $user->id)->name }}
                                            </div>
                                        </td>

                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--経費の合計額-->
                                                {{ $totalExpensesByUser[$user->id]}}円
                                            </div>
                                        </td>

                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--登録日-->
                                                {{ $user->created_at }}
                                            </div>
                                        </td>
                                        <td class="p-0 text-right text-sm font-medium">
                                            <div class="flex ">


                                                <div>
                                                    <form action="/admin/users/{{ $user->id }}" method="post" class="inline-block text-gray-500 font-medium" role="menuitem" tabindex="-1" onsubmit="return confirm('本当に削除しますか？');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-emerald-700 py-2 px-4 text-white rounded-md md:hover:bg-emerald-800 transition-colors">削除</button>
                                                    </form>
                                                </div>
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
                    {{ $users->links() }}
                </div>


                @if ($admins->isNotEmpty())
                <div class="max-w-7xl mx-auto mt-20">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            管理者ID</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            管理者</th>

                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            登録日</th>

                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--ユーザーID-->
                                                {{ $admin->id }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--ユーザー名-->
                                                {{ $admin->firstWhere('id', $admin->id)->name }}
                                            </div>
                                        </td>


                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div><!--登録日-->
                                                {{ $admin->created_at }}
                                            </div>
                                        </td>
                                        <td class="p-0 text-right text-sm font-medium">
                                            <div class="flex ">


                                                <div>
                                                    <form action="/admin/users/{{ $admin->id }}" method="post" class="inline-block text-gray-500 font-medium" role="menuitem" tabindex="-1" onsubmit="return confirm('本当に削除しますか？');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-emerald-700 py-2 px-4 text-white rounded-md md:hover:bg-emerald-800 transition-colors">削除</button>
                                                    </form>
                                                </div>
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
                    {{ $admins->links() }}
                </div>



            </div>
        </div>
    </main>
    <footer class="bg-sky-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-4 text-center">
                <p class="text-white text-sm">登録者一覧</p>
            </div>
        </div>
    </footer>
</body>

</html>