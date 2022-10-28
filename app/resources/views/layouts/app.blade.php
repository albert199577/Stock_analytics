<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <title>Stock - @yield('title')</title>
</head>
<body>
    <nav class="flex flex-row justify-between p-4 mb-5 shadow">
        <div class="text-blue-700 text-lg font-mono">
            Stock
        </div>
        <ul class="grid grid-cols-3 gap-4 text-green-700">
            <li>
                <a href="{{ route('stock.index') }}">
                    首頁
                </a>
            </li>
            <li>
                <a href="{{ route('search.index') }}">
                    搜股
                </a>
            </li>
            <li>
                <a href="">
                    個股查詢
                </a>
            </li>
        </ul>
    </nav>
    @yield('content')
</body>
</html>