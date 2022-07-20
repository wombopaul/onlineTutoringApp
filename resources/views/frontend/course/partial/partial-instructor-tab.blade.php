<div class="tab-pane fade" id="Instructor" role="tabpanel" aria-labelledby="Instructor-tab">
    <div class="row">
        <h6 class="mb-4 col-12">{{ __('app.meet_your_instructor') }}</h6>
        <div class="col-md-7 col-lg-12 col-xl-7 p-0">
            <div class="meet-your-instructor-left d-flex">
                <div class="meet-instructor-img-wrap flex-shrink-0">
                    <img src="{{ asset(@$course->user->image_path) }}" alt="img">
                </div>
                <div class="flex-grow-1">
                    <p class="font-medium color-heading mb-1">{{ @$course->instructor->name }}</p>
                    <p class="font-12 mb-2">{{ @$course->instructor->professional_title }}</p>
                    <div class="teacher-tag color-hover bg-light-purple font-medium font-14 radius-4">{{ __('app.instructor') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-12 col-xl-5 p-0">
            <div class="meet-your-instructor-right">
                <div class="d-flex">
                    <div>
                        <div class="meet-instructor-extra-info-item color-heading"><span class="iconify" data-icon="bi:star"></span>{{ $total_user_review }} {{ __('app.rating') }}</div>
                        <div class="meet-instructor-extra-info-item color-heading"><span class="iconify" data-icon="ph:student"></span>{{ @$course->orderItems->count() }} {{ __('app.students') }}</div>
                    </div>
                    <div>
                        <div class="meet-instructor-extra-info-item color-heading"><span class="iconify" data-icon="cil:badge"></span>
                            {{ get_instructor_ranking_level(@$course->instructor->user_id) }}
                        </div>
                        <div class="meet-instructor-extra-info-item color-heading"><span class="iconify" data-icon="ph:monitor-light"></span>{{ @$course->instructor->courses->count() }} {{ __('app.courses') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 meet-your-instructor-content-part">
            <h6 class="font-16">{{ __('app.about_instructor') }}</h6>
            <p>{{ @$course->instructor->about_me }}</p>

        </div>
    </div>
</div>
