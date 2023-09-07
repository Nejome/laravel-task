<!doctype html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الصفحة الرئيسية</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<header class="mx-auto mt-4">
    <div class="container">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="/"><h1>الموارد البشرية</h1></a>
                    @if(auth()->check())
                        <ul class="d-none d-md-block">
                            <li><a href="{{route('applications.pending')}}" class="@if(request()->route()->getName() == 'applications.pending') active @endif">الطلبات قيد الإنتظار</a></li>

                            <li><a href="{{route('applications.index')}}" class="@if(request()->route()->getName() == 'applications.index') active @endif">التقرير</a></li>
                        </ul>
                    @endif
                </div>
                <div>
                    @if(auth()->check())
                        <div class="d-flex gap-4 align-items-center">
                            <div class="d-flex flex-column user">
                                <span class="name">{{auth()->user()->name}}</span>
                                <span class="role">{{auth()->user()->role->name()}}</span>
                            </div>
                            <form method="POST" action="{{route('sessions.destroy')}}">
                                @csrf
                                @method('DELETE')
                                <button class="hr-logout-btn d-flex align-items-center gap-2">
                                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                                    <span>تسجيل الخروج</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{route('sessions.create')}}" class="btn1">تسجيل الدخول</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<main class="mt-5">
    <div class="container">
        {{$slot}}
    </div>
</main>
</body>
</html>
