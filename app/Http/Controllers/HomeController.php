<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Course;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('Asia/Taipei');
        $today = date('Y-m-d');
        $now = date('Y-m-d H:i:s');

        $active_classes = Teacher::where('t_date', '=', $today)->orderBy('t_time')->get();

        $user = auth()->user();
        $books = Teacher::where('student', '=', $user->name)->where('t_date', '>=', $today)->
                        orderBy('t_date')->orderBy('t_time')->get();

        return view('home', compact('now', 'user', 'books', 'active_classes'));
    }

    public function history()
    {
        date_default_timezone_set('Asia/Taipei');
        $now = date('Y-m-d H:i:s');
        $user = auth()->user();
        $all_books = Teacher::where('student', '=', $user->name)->
                            orderBy('t_date')->orderBy('t_time')->get();

        return view('home.history', compact('all_books', 'user', 'now'));
    }

    public function cancel(request $request)
    {
        $user = auth()->user();
        $date = $request->input('date');
        $time = $request->input('time');

        Teacher::where('t_date', $date)->where('t_time', $time)
                ->update(['student' => null, 'booked' => '0', 'student_ID' => null]);

        User::where('email', $user->email)->update(['ticket' => $user->ticket += 1]);

        return redirect('home');
    }

    public function add(request $request)
    {
        
        $email = $request->input('email');
        $tickets = $request->input('tickets');
        $student = DB::table('users')->where('email', $email)->first();
        $remails = $student->ticket;
        $addvalue = $remails + $tickets;

        DB::table('users')->where('email', $email)->update(['ticket' => $addvalue]);

        return redirect('home');
    }
}
