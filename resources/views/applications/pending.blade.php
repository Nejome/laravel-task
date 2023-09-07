<x-layout>
    <h3 class="title">الطبات قيد الإنتظار</h3>
    @if(session()->has('success'))
        <div class="hr-alert-success d-flex align-items-center gap-2 mt-3">
            <span><i class="fa-regular fa-circle-check"></i></span>
            <span>{{session()->get('success')}}</span>
        </div>
    @endif
    @foreach($applications as $application)
        <div class="hr-card mt-3">
            <div class="row">
                <div class="col-6 col-md-3">
                    <label class="hr-label">الاسم</label>
                    <p class="value-text">{{$application->name}}</p>
                </div>
                <div class="col-6 col-md-3">
                    <label class="hr-label">تاريخ الميلاد</label>
                    <p class="value-text">{{$application->dob}}</p>
                </div>
                <div class="col-6 col-md-3">
                    <label class="hr-label">الجنس</label>
                    <p class="value-text">{{$application->gender}}</p>
                </div>
                <div class="col-6 col-md-3">
                    <label class="hr-label">الجنسية</label>
                    <p class="value-text">{{$application->nationality}}</p>
                </div>
                <div class="col-12 col-md-3">
                    <label class="hr-label">الملف</label>
                    <p class="value-text">
                        <a href="{{url("/storage/{$application->cv}")}}" target="_blank">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            عرض
                        </a>
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <form method="POST" action="{{route($actionUrl, ['application' => $application])}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="{{\App\Enums\ApplicationActionEnum::REJECTED}}">
                    <button class="btn3 btn3-danger">
                        <i class="fa-solid fa-x"></i>
                        رفض
                    </button>
                </form>
                <form method="POST" action="{{route($actionUrl, ['application' => $application])}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="{{\App\Enums\ApplicationActionEnum::ACCEPTED}}">
                    <button class="btn3 btn3-success">
                        <i class="fa-solid fa-check"></i>
                        قبول
                    </button>
                </form>
            </div>
        </div>
    @endforeach
    <div class="mt-3">
        {{$applications->links()}}
    </div>
</x-layout>
