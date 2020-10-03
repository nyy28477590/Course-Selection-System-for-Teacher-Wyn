@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your information') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                @can('admin')
                                <th>Role</th>
                                @endcan
                                @can('user')
                                <th>Tickets</th>
                                @endcan
                                <th>E-mail</th>
                                @can('admin')
                                <th>Course</th>
                                @endcan
                                @can('user')
                                <th>History</th>
                                @endcan
                            </tr>
                            <tr>
                                <td>{{ $user->name }}</td>
                                @can('admin')
                                <td>Teacher</td>
                                @endcan
                                @can('user')
                                <td>{{ $user->ticket }}</td>
                                @endcan
                                <td>{{ $user->email }}</td>
                                @can('admin')
                                <td><a href="{{ route('course.course') }}">Course</a></td>
                                @endcan
                                @can('user')
                                <td><a href="{{ route('home.history') }}">History</a></td>
                                @endcan
                            </tr>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@can('user')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your booking list') }}</div>
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
                                <th>Cancel</th>
                            </tr>
                            <form action="{{ route('home.cancel') }}" method="post">
                            {{ csrf_field() }}
                                @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->t_date }}</td>
                                    <td>{{ $book->t_time }}</td>
                                    @if (strtotime($book->t_date. " ". $book->t_time) >= strtotime($now))
                                    <td>
                                        <input type="hidden" name="date" value="{{ $book->t_date}}">
                                        <input type="hidden" name="time" value="{{ $book->t_time}}">
                                        <input type="submit" value="cancel">
                                    </td>
                                    @else
                                    <td>Finished</td>
                                    @endif
                                </tr>
                                @endforeach
                            </form>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan

@can('admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Today's class") }}</div>
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
                            </tr>
                                @foreach($active_classes as $class)
                                <tr>
                                    <td>{{ $class->t_date }}</td>
                                    <td>{{ $class->t_time }}</td>
                                    <td>{{ $class->student }}</td>
                                </tr>
                                @endforeach
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan

@can('admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sell the tickets') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <table class="table">
                            <form action="{{ route('home.add') }}" method="post">
                            {{ csrf_field() }}
                                <label for="email">Student's Email: </label>
                                <input type="email" id="email" name="email">
                                <label for="tickets">Ticket quantities: </label>
                                <input type="text" id="tickets" name="tickets">
                                <br>
                                <input type="submit" value="Submit">
                            </form>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan

@endsection
