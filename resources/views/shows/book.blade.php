@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seats for {{ $show->date }} @ {{ $show->time }}</h2>

    @if(auth()->user()->is_admin)
        <div class="row">
            @foreach($seats as $seat)
                <div class="col-2 mb-3">
                    <div class="card {{ $seat->is_booked ? 'bg-secondary text-white' : 'bg-success text-white' }}">
                        <div class="card-body p-2">
                            <h6 class="card-title text-center mb-0">{{ $seat->seat_number }}</h6>
                            @if($seat->is_booked)
                                <small>Booked by: {{ $seat->user->name ?? 'N/A' }}</small>
                            @else
                                <small>Available</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <form id="bookingForm">
            @csrf

            <!-- 👇 DateTime Picker added here -->
            <div class="form-group mb-3">
                <label for="show_datetime">Select Show Date & Time</label>
                <input type="datetime-local" id="show_datetime" name="show_datetime" class="form-control" required>
            </div>

            <div class="row">
                @foreach($seats as $seat)
                    <div class="col-2 mb-3">
                        <label class="btn btn-{{ $seat->is_booked ? 'secondary' : 'success' }}">
                            <input type="checkbox" name="seats[]" value="{{ $seat->id }}" {{ $seat->is_booked ? 'disabled' : '' }}> {{ $seat->seat_number }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-primary" type="submit">Book Selected Seats</button>
        </form>

        <div id="statusMsg"></div>
    @endif
</div>

@if(!auth()->user()->is_admin)
<script>
    $(document).ready(function () {
        $('#bookingForm').submit(function(e){
            e.preventDefault();

            let seat_ids = $("input[name='seats[]']:checked").map(function(){
                return this.value;
            }).get();

            let show_datetime = $('#show_datetime').val();
            if (!show_datetime) {
                alert('Please select a show date and time.');
                return;
            }

            $.ajax({
                url: '/bookings',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    seat_ids: seat_ids,
                    show_datetime: show_datetime
                },
                success: function(res){
                    $('#statusMsg').html('<div class="alert alert-success">' + res.message + '</div>');
                    setTimeout(() => location.reload(), 1000);
                },
              
                error: function(xhr) {
                    console.error(xhr.responseText);

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function(message) {
                                    errorHtml += '<li>' + message + '</li>';
                                });
                            }
                        }

                        errorHtml += '</ul></div>';
                        $('#statusMsg').html(errorHtml);
                    } else {
                        $('#statusMsg').html('<div class="alert alert-danger">Booking failed. Please try again.</div>');
                    }
                }
            });
        });
    });
</script>
@endif
@endsection

