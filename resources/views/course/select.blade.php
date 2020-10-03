@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tickets:') }}{{ $user->ticket }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{{ route('course.post', 'selected_date') }}}" method="POST">
                        {{ csrf_field() }}
                        {{ __('Date')}}:
                        <br />
                            <input type="date" name="selected_date" id="selected_date" value="{{ $selected_date }}" />
                            <input type="submit" value="Find the available course">
                        <br /><br />
                    </form>
                    
                    <p>{{ __('Opened classes')}}</p>
                    <table class="table">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Student</th>
                        </tr>
                        @foreach ($datedcourses as $datedcourse)
                        <tr>
                            <td>{{ $datedcourse->t_date}}</td>
                            <td>{{ $datedcourse->t_time}}</td>
                            @if ($datedcourse->student == null)
                                <td>
                                    <form action="{{ route('course.book', 'selected_date') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="t_date" value="{{ $datedcourse->t_date }}">
                                        <input type="hidden" name="t_time" value="{{ $datedcourse->t_time }}">
                                        <input type="hidden" name="student" value="{{ $user->name }}">
                                        <input type="submit" value="Book">
                                    </form>
                                </td>
                            @else
                            <td>{{ $datedcourse->student }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
