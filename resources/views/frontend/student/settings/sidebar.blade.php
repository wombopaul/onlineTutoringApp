<div class="col-lg-3 p-0">
    <div class="student-profile-left-part">
        <h6>{{ @Auth::user()->name }}</h6>
        <ul>
            <li><a href="{{ route('student.profile') }}" class="font-medium font-15 {{active_if_full_match('student/profile')}}">{{__('app.profile')}}</a></li>
        </ul>
    </div>
</div>
