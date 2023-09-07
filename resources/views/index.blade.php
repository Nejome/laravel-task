<x-layout>
    <div class="hr-card">
        <h3 class="title">تعبئة نموذج الطلب</h3>
        @if($errors->any())
            <div class="hr-alert-danger d-flex align-items-center gap-2 mt-3">
                <span><i class="fa-regular fa-circle-xmark"></i></span>
                <span>يرجى التحقق من البيانات المدخلة</span>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="hr-alert-success d-flex align-items-center gap-2 mt-3">
                <span><i class="fa-regular fa-circle-check"></i></span>
                <span>{{session()->get('success')}}</span>
            </div>
        @endif
        @if(!session()->has('success'))
            <form class="mt-3" method="POST" action="{{route('applications.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="name">الاسم</label>
                        <input id="name" name="name" value="{{old('name')}}" type="text" class="hr-input mt-1">
                        @if($errors->has('name'))
                            <p class="hr-error-message-text text-danger mt-1">
                                <i class="fa-regular fa-circle-xmark"></i>
                                {{$errors->first('name')}}
                            </p>
                        @endif
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="dob">تاريخ الميلاد</label>
                        <input id="dob" type="date" name="dob" value="{{old('dob')}}" class="hr-input mt-1">
                        @if($errors->has('dob'))
                            <p class="hr-error-message-text text-danger mt-1">
                                <i class="fa-regular fa-circle-xmark"></i>
                                {{$errors->first('dob')}}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="nationality">الجنسية</label>
                        <input id="nationality" name="nationality" value="{{old('nationality')}}" type="text" class="hr-input mt-1">
                        @if($errors->has('nationality'))
                            <p class="hr-error-message-text text-danger mt-1">
                                <i class="fa-regular fa-circle-xmark"></i>
                                {{$errors->first('nationality')}}
                            </p>
                        @endif
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label>الجنس</label>
                        <div class="d-flex gap-4 mt-3">
                            <div>
                                <input type="radio" name="gender" value="male" id="male" @checked(old('gender') == 'male')>
                                <label for="male">ذكر</label>
                            </div>

                            <div>
                                <input type="radio" name="gender" value="female" id="female" @checked(old('gender') == 'female')>
                                <label for="female">انثى</label>
                            </div>
                        </div>
                        @if($errors->has('gender'))
                            <p class="hr-error-message-text text-danger mt-1">
                                <i class="fa-regular fa-circle-xmark"></i>
                                {{$errors->first('gender')}}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="cv">ملف السيرة الذاتية</label>
                        <input id="cv" name="cv" type="file" class="hr-input" accept="application/pdf">
                        @if($errors->has('cv'))
                            <p class="hr-error-message-text text-danger mt-1">
                                <i class="fa-regular fa-circle-xmark"></i>
                                {{$errors->first('cv')}}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit" class="btn2 mt-1">ارسال الطلب</button>
                </div>
            </form>
        @endif
    </div>
</x-layout>
