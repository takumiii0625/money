<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{Auth::user()->name}}さん {{ __("You're logged in!") }}
                </div>
                <!-- <x-primary-button>お問い合わせ</x-primary-button>-->



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
                            <a href="/items" class="login-link">
                                <div class="text-lg font-bold">投稿一覧</div>
                            </a>
                            <a href="/costs" class="register-link">
                                <div class="text-lg font-bold"> 経費一覧</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>


    <img src="{{ asset('/storage/images/3.jpg') }}" class="center-image">



</x-app-layout>
<footer class="bg-white-800">

    <div class="py-4 text-center">
        <p class="text-black text-sm">topページ</p>
    </div>

</footer>
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

    h1 {
        font-size: 1.5rem;
        /* フォントサイズを大きく */
        font-weight: bold;
        /* フォントの太さを変更 */
        color: #000000;
        /* 色を変更 */
        text-align: center;
        /* センター揃え */
        margin-top: 1rem;
        /* 上の余白 */
        margin-bottom: 1rem;
        /* 下の余白 */
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

    .center-image {
        width: 100%;
        display: block;
        margin-top: 11rem;
        /* 上の余白 */
        margin-bottom: 2rem;
        /* 下の余白 */
    }
</style>