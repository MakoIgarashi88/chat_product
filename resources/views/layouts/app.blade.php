<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @auth
        <script>window.Laravel = {api_token: "{{ Auth::user()->api_token }}"}</script>
    @else
        <script>window.Laravel = {api_token: "Unauthorized"}</script>
    @endauth

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <v-app id="app">
        <v-app-bar app color="secondary" dark dense absolute>
            <v-toolbar-title>
                <v-btn text href="/">
                    {{ config('app.name', 'Laravel') }}
                </v-btn>
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
            <!-- Authentication Links -->
            @guest
                <v-btn small text href="/login">
                    ログイン
                </v-btn>
                <v-btn small text href="/register">
                    新規登録
                </v-btn>
            @else
                <v-menu offset-y open-on-hover>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn text v-bind="attrs" v-on="on" >
                            {{ Auth::user()->name }}
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-item href="/logout" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            <v-list-item-title>ログアウト</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/mypage">
                            <v-list-item-title>マイページ</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/topic">
                            <v-list-item-title>トピック</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </v-app-bar>

        <main class="py-4">
            @yield('content')
            @if (!View::hasSection('content'))
                <main-component/>
            @endif
        </main>
    </v-app>
</body>
</html>
