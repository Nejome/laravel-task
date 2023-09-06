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

<div class="container">
    <header class="mx-auto mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="/"><h1>الموارد البشرية</h1></a>
                <ul class="d-none d-md-block">
                    <li><a href="#" class="active">الرئيسية</a></li>

                    <li><a href="#">التقارير</a></li>
                </ul>
            </div>

            <div>
                <a href="/login" class="btn1">تسجيل الدخول</a>
            </div>
        </div>
    </header>

    <main class="mt-5">
        {{$slot}}
    </main>
</div>

</body>
</html>
