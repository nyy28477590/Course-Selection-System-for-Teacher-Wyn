@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your booking history') }}</div>
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
                                <th>Status</th>
                            </tr>
                            @foreach ( $all_books as $all_book)
                            <tr>
                                <td>{{ $all_book->t_date }}</td>
                                <td>{{ $all_book->t_time }}</td>
                                @if (strtotime($all_book->t_date.$all_book->t_time) >= strtotime($now))
                                    <td>
                                        <form action="{{ route('home.cancel') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="date" value="{{ $all_book->t_date }}">
                                            <input type="hidden" name="time" value="{{ $all_book->t_time }}">
                                            <input type="submit" value="cancel">
                                        </form>
                                    </td>
                                
                                @else
                                    <td>Finished</td>
                                @endif
                            </tr>
                            @endforeach
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
