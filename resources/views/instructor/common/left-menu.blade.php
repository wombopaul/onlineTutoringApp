<div class="instructor-profile-left-part bg-white">
    <nav class="account-page-menu">
        <ul>
            <li><a href="{{route('instructor.dashboard')}}" class="{{active_if_full_match('instructor/dashboard')}} {{ @$navDashboardActiveClass }}"><span class="iconify mr-15" data-icon="feather:home"></span>{{__('app.dashboard')}}</a></li>
            <li><a href="{{route('instructor.course.create')}}" class="{{active_if_full_match('instructor/course/create')}} {{ @$navCourseUploadActiveClass }}"><span class="iconify mr-15" data-icon="feather:upload"></span>{{__('app.upload_course')}}</a></li>
            <li><a href="{{route('instructor.course')}}" class="{{active_if_full_match('instructor/course')}} {{ @$navCourseActiveClass }}" ><span class="iconify mr-15" data-icon="ion:log-in-outline"></span>{{__('app.my_courses')}}</a></li>

            <li><a href="{{ route('instructor.all-student') }}" class="{{ @$navAllStudentActiveClass }}"><span class="iconify mr-15" data-icon="ph:student"></span>{{__('app.all_students')}}</a></li>
            <li><a href="{{ route('notice-board.course-notice.index') }}" class="{{ @$navNoticeBoardActiveClass }}"><span class="iconify mr-15" data-icon="ep:data-board"></span>{{__('app.notice_board')}}</a></li>
            <li><a href="{{ route('live-class.course-live-class.index') }}" class="{{ @$navLiveClassActiveClass }}"><span class="iconify mr-15" data-icon="fluent:live-24-regular"></span>{{__('app.live_class')}}</a></li>
            <li><a href="{{route('instructor.certificate.index')}}" class="{{ @$navCertificateActiveClass }}" ><span class="iconify mr-15" data-icon="fluent:certificate-20-regular"></span>{{__('app.certificate')}}</a></li>

            <li><a href="{{route('discussion.index')}}" class="{{ @$navDiscussionActiveClass }}" ><span class="iconify mr-15" data-icon="octicon:comment-discussion-24"></span>{{__('app.discussion')}}</a></li>
            <li class="menu-has-children current-menu-item {{@$navFinanceActiveClass}}">
                <span class="toggle-account-menu">
                    <span class="iconify" data-icon="fontisto:angle-down"></span>
                </span>
                <a href="#" class="{{@$navFinanceActiveClass}}"><span class="iconify mr-15" data-icon="system-uicons:heart-rate"></span>{{__('app.finance')}}</a>
                <ul class="account-sub-menu">
                    <li><a href="{{ route('finance.analysis.index') }}" class="{{ @$subNavAnalysisActiveClass }}">{{__('app.analysis')}}</a></li>
                    <li><a href="{{ route('finance.withdraw-history.index') }}" class="{{ @$subNavWithdrawActiveClass }}">{{__('app.withdraw_history')}}</a></li>
                </ul>
            </li>
            <li><a href="{{route('instructor.profile')}}" class="{{active_if_full_match('instructor/profile')}}" ><span class="iconify mr-15" data-icon="bx:bx-user"></span>{{__('app.profile')}}</a></li>
            <li><a href="{{route('instructor.my-card')}}" class="{{ @$navPaymentActiveClass }}" ><span class="iconify mr-15" data-icon="carbon:settings"></span>Payment Settings</a></li>
        </ul>
    </nav>
</div>
