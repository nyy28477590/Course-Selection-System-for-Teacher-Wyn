@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        Teacher {{ $user->name }} 
                        <form action="{{ route('course.tpost', 'firstDate')}}" method="post">
                        {{ csrf_field() }}
                            <input type="date" name="firstDate" value="{{ $firstDate }}">
                            <input type="submit" value="Find the week">
                        </form>
                    </p>
                    <form method="POST" action="{{ route('course.open')}}">
                    {{ csrf_field() }}
                        <table class="table">
                            <tr>
                                <td>Time/Date</td>
                                @for ($date = $startDate; $date <= $endDate; $date->modify('+1 day'))
                                    <td>{{ $date->format('m/d') }}</td>
                                @endfor
                            </tr>
                            
                            @for ($time = $startTime; $time<=$endTime; $time+=1800)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($time)->format('H:i') }}</td>
                                    @for ($j = 0; $j < 7; $j++)
                                        <td>
                                            <input type="checkbox" name="t_dates[]" value="{{ $contDate->modify('+'. $j. 'day')->format('Y-m-d') }}, {{ \Carbon\Carbon::parse($time)->format('H:i:s') }}">
                                        </td>
                                        <input type="hidden" name="none" value="{{ $contDate->modify('-'. $j. 'day')->format('Y-m-d') }}">
                                    @endfor
                                </tr>
                            @endfor
                            <tr>
                                <td><input type="submit" value="Open classes"></td>
                            </tr>
                        </table>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
