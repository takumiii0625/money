<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>テスト</title>
</head>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<body>

    @if ($todo_lists->isNotEmpty())
    <ul>
        @foreach ($todo_lists as $item)
        <li>
            {{ $item->name }}
        </li>
        @endforeach
    </ul>
    @endif








</body>

</html>