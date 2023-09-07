<x-layout>
    <div class="hr-card mt-3">
        <h3 class="title">التقرير</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">الرقم</th>
                <th scope="col">الاسم</th>
                <th scope="col">تاريخ الميلاد</th>
                <th scope="col">الجنس</th>
                <th scope="col">الجنسية</th>
                <th scope="col">السيرة الذاتية</th>
                <th scope="col">التاريخ</th>
                <th scope="col">رد المنسق</th>
                <th scope="col">رد المدير</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <th scope="row">{{$application->id}}</th>
                    <td>{{$application->name}}</td>
                    <td>{{$application->dob}}</td>
                    <td>{{$application->gender}}</td>
                    <td>{{$application->nationality}}</td>
                    <th>
                        <a href="{{url("/storage/{$application->cv}")}}" target="_blank">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            عرض
                        </a>
                    </th>
                    <td>{{$application->created_at->toDateString()}}</td>
                    <td>
                        <span class="hr-badge {{$application->coordinator_action->value}}">{{$application->coordinator_action->name()}}</span>
                    </td>
                    <td>
                        <span class="hr-badge {{$application->manager_action->value}}">{{$application->manager_action->name()}}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{$applications->links()}}
        </div>
    </div>
</x-layout>
