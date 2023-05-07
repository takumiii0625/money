<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{Auth::user()->name}}管理者 {{ __("You're logged in!") }}
                </div>

            </div>
        </div>
    </div>

    <body class="antialiased">
        <div class="stripes"></div>
        <div class="flex justify-center">
            <div class="container">
                <div class="content">
                    <h1>経費計算サイト</h1>
                    <div class="auth-links">
                        <div class="p-6 text-right">
                            <a href="items" class="login-link">
                                <div class="text-lg font-bold">投稿一覧</div>
                            </a>
                            <a href="costs" class="register-link">
                                <div class="text-lg font-bold"> 経費一覧</div>
                            </a>
                            <a href="users" class="register-link">
                                <div class="text-lg font-bold"> 登録者一覧</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>


</x-admin-layout>
<style>
    body {

        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Arial', sans-serif;
    }

    .container {
        border: 2px solid #333;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        max-width: 600px;
        /* この行を追加します */
    }

    .content {
        display: inline-block;
    }


    .auth-links {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth-links a {
        display: inline-block;
        border: 2px solid #333;
        border-radius: 8px;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: bold;
        color: #333;
        margin: 0 10px;
    }

    .auth-links a:hover {
        color: #fff;
        background-color: #333;
        transition: 0.3s;
    }
</style>