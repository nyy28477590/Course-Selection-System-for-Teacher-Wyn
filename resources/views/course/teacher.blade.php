@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Opened classes') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Student</th>
                            <th>Delete</th>
                        </tr>
                            @foreach($active_classes as $class)
                            <tr>
                                <td>{{ $class->t_date }}</td>
                                <td>{{ $class->t_time }}</td>
                                <td>{{ $class->student }}</td>
                                <td>
                                    <form action="{{ route('course.delete') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="date" value="{{ $class->t_date }}">
                                        <input type="hidden" name="time" value="{{ $class->t_time }}">
                                        <input type="hidden" name="name" value="{{ $class->student }}">
                                        <input type="hidden" name="id" value="{{ $class->student_ID }}">
                                        <input type="submit" value="deleate">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
