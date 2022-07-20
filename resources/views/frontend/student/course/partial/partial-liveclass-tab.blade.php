<div class="tab-pane fade" id="LiveClass" role="tabpanel" aria-labelledby="LiveClass-tab">
    <div class="row">
        <div class="col-12">
            <div class="after-purchase-course-watch-tab bg-white p-30">
                <!-- If there is no data Show Empty Design Start -->
                <div class="empty-data d-none">
                    <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                    <h5 class="my-3">Empty Live Class </h5>
                </div>
                <!-- If there is no data Show Empty Design End -->

                <div class="course-watch-live-class-wrap instructor-quiz-list-page">
                    <ul class="nav nav-tabs assignment-nav-tabs live-class-list-nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab"
                                    aria-controls="upcoming" aria-selected="true">Upcoming
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="past-tab" data-bs-toggle="tab" data-bs-target="#past" type="button" role="tab"
                                    aria-controls="past" aria-selected="false">Past
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content live-class-list" id="myTabContent">
                        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                            @if(count($upcoming_live_classes))
                            <div class="table-responsive table-responsive-xl">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Starting Time</th>
                                        <th scope="col">Time Duration</th>
                                        <th scope="col">Topic</th>
                                        <th scope="col">Meeting Link</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($upcoming_live_classes as $upcoming_live_class)
                                    <tr>
                                        <td>{{ $upcoming_live_class->date }}</td>
                                        <td>{{ $upcoming_live_class->time }}</td>
                                        <td>{{ $upcoming_live_class->duration }} minutes</td>
                                        <td><div class="course-watch-live-class-topic">{{ Str::limit($upcoming_live_class->class_topic, 50) }}</div></td>
                                        <td>
                                            <div class="course-watch-meeting-link ">
                                                <a href="{{ $upcoming_live_class->join_url }}" class="color-hover">Go To Meeting</a>
                                                <span class="iconify copyZoomUrl" data-url="{{ $upcoming_live_class->join_url }}" data-icon="akar-icons:copy"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <!-- If there is no data Show Empty Design Start -->
                                <div class="empty-data">
                                    <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                                    <h5 class="my-3">Empty Upcoming Class</h5>
                                </div>
                                <!-- If there is no data Show Empty Design End -->
                            @endif
                        </div>
                        <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="upcoming-tab">
                            @if(count($past_live_classes))
                            <div class="table-responsive table-responsive-xl">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Starting Time</th>
                                        <th scope="col">Time Duration</th>
                                        <th scope="col">Topic</th>
                                        <th scope="col">Meeting Link</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($past_live_classes as $past_live_class)
                                    <tr>
                                        <td>{{ $past_live_class->date }}</td>
                                        <td>{{ $past_live_class->time }}</td>
                                        <td>{{ $past_live_class->duration }} minutes</td>
                                        <td><div class="course-watch-live-class-topic">{{ Str::limit($past_live_class->class_topic, 50) }}</div></td>
                                        <td>
                                            <div class="course-watch-meeting-link ">
                                                {{ Str::limit($past_live_class->join_url, 50) }}
                                                <span class="iconify copyZoomUrl" data-url="{{ $past_live_class->join_url }}" data-icon="akar-icons:copy"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <!-- If there is no data Show Empty Design Start -->
                                <div class="empty-data">
                                    <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                                    <h5 class="my-3">Empty Past Class</h5>
                                </div>
                                <!-- If there is no data Show Empty Design End -->
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
