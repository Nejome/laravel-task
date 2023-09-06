<x-layout>
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            <div class="hr-card">
                <h3 class="title text-center">تسجيل الدخول</h3>
                @if(session()->has('danger'))
                    <div class="hr-alert-danger d-inline-block align-items-center gap-2 mt-3">
                        <span><i class="fa-regular fa-circle-xmark"></i></span>
                        <span>{{session()->get('danger')}}</span>
                    </div>
                @endif
                <form method="POST" action="{{route('sessions.store')}}" class="mt-3">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="email">البريد الإلكتروني</label>
                            <input id="email" name="email" type="email" class="hr-input mt-1">
                            @if($errors->has('email'))
                                <p class="hr-error-message-text text-danger mt-1">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                    {{$errors->first('email')}}
                                </p>
                            @endif
                        </div>
                        <div class="col-12 mt-3">
                            <label for="password">كلمة المرور</label>
                            <input id="password" name="password" type="password" class="hr-input mt-1">
                            @if($errors->has('password'))
                                <p class="hr-error-message-text text-danger mt-1">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                    {{$errors->first('password')}}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn2 mt-1">تسجيل الدخول</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
