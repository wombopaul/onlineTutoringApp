<div class="tab-pane fade" id="Curriculum" role="tabpanel" aria-labelledby="Curriculum-tab">
    <div class="curriculum-content">
        <div class="accordion" id="accordionExample">
            @forelse(@$course->lessons as $key => $lesson)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $key }}">
                        <button class="accordion-button font-medium font-18 {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapseOne">
                            {{ $lesson->name }}
                        </button>
                    </h2>
                    <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="play-list">

                                <!-- Note End-->
                                <!-- If User Logged In then add Class Name in play-list-item = "venobox"-->
                                <!-- If Preview has for this course add Class Name in play-list-item = "preview-enabled"-->
                                <!-- Note Start-->

                                @forelse($lesson->lectures as  $lecture)
                                    @if($lecture->lecture_type == 1)
                                    <!-- Play List Item Start-->
                                    <a class="play-list-item d-flex align-items-center justify-content-between venobox preview-enabled" data-autoplay="true" data-maxwidth="800px" data-vbtype="video" data-href="

                                    @if($lecture->lecture_type == 1)
                                        @if($lecture->type == 'video')
                                            {{getVideoFile($lecture->file_path)}}
                                        @elseif($lecture->type == 'youtube')
                                            https://www.youtube.com/embed/{{ $lecture->url_path }}
                                        @elseif($lecture->type == 'vimeo')
                                            https://vimeo.com/{{ $lecture->url_path }}
                                        @endif
                                    @endif
                                    ">
                                        <div class="play-list-left d-flex align-items-center">
                                            <div><img src="{{ asset('frontend/assets/img/courses-img/play.svg') }}" alt="play"></div>
                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                        <div class="play-list-right d-flex">
                                            <span class="show-preview">Preview</span>
                                            <span class="video-time-count">{{ $lecture->file_duration }}</span>
                                        </div>
                                    </a>
                                    <!-- Play List Item End-->
                                    @else

                                    <!-- Play List Item Start-->
                                    <a class="play-list-item d-flex align-items-center justify-content-between" data-autoplay="true" data-maxwidth="800px" data-vbtype="video" data-href="">
                                        <div class="play-list-left d-flex align-items-center">
                                            <div><img src="{{ asset('frontend/assets/img/courses-img/play.svg') }}" alt="play"></div>
                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                        <div class="play-list-right d-flex">
                                            <span class="show-preview"></span>
                                            <span class="video-time-count"><span class="iconify me-5" data-icon="ant-design:lock-outlined"></span>{{ $lecture->file_duration }}</span>
                                        </div>
                                    </a>
                                    <!-- Play List Item End-->
                                    @endif

                                @empty
                                    <div class="row">
                                        <p>{{ __('app.no_data_found') }}!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <p>{{ __('app.no_data_found') }}!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
