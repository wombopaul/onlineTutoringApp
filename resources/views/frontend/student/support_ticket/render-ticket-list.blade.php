@if(count($tickets))
<div class="table-responsive table-responsive-xl">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Ticket Number</th>
            <th scope="col">Subject</th>
            <th scope="col">Last Response</th>
            <th scope="col">Priority</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->ticket_number }}</td>
                <td>{{ $ticket->subject }}</td>
                <td>15-04-2022</td>
                <td>{{ @$ticket->priority->name }}</td>
                <td>
                    @if($ticket->status == 1) Open @endif
                    @if($ticket->status == 2) <div class="color-orange">Closed</div> @endif
                </td>
                <td>
                    <a href="{{ route('student.support-ticket.show', $ticket->uuid) }}" class="theme-btn theme-button1 green-theme-btn default-hover-btn">
                        View Details</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination Start -->
@if(@$tickets->hasPages())
    {{ @$tickets->links('frontend.paginate.paginate') }}
@endif
<!-- Pagination End -->
@else
    <div class="no-course-found text-center">
        <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
        <h5 class="mt-3">Empty Ticket</h5>
    </div>
@endif
