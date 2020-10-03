<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Course;
use App\User;
use \Carbon\Carbon;
use DB;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //學生端首頁-GET
    public function select($selected_date)
    {
        
        $user = auth()->user();
        $teachers = Teacher::all();
        $freecourses = Teacher::where('t_date', '=', $selected_date)->where('booked', '=', 0)->get();
        $datedcourses = Teacher::where('t_date', '=', $selected_date)->get();
        $courses = Course::all();
        return view('course.select', compact('user', 'teachers', 'courses', 'freecourses', 'selected_date', 'datedcourses'));
    }

    //學生端時間查詢-POST
    public function post(Request $request)
    {
        $selected_date = $request->input('selected_date');
        
        return redirect()->route('course.select', compact('selected_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //學生端選課-POST
    public function book(Request $request)
    {
        
        $user = auth()->user();
        $selected_date = $request->input('t_date');
        $t_time = $request->input('t_time');
        $student = $request->input('student');
        
        Teacher::where('t_date', $selected_date)->where('t_time', $t_time)
                ->update(['student' => $student, 'booked' => '1', 'student_ID' => $user->id]);

        User::where('email', $user->email)->update(['ticket' => $user->ticket -= 1]);

        return redirect()->back()->with('status','Booking Successful');
        //return redirect()->route('course.index', compact('selected_date'));
    }

    //教師端開課-GET
    public function creates()
    {

        $user = auth()->user();
        $firstDate = date('Y-m-d');
        $startDate = new \DateTime($firstDate);
        $endDate = new \DateTime(date('Y-m-d', strtotime($firstDate.'+6 days')));
        $contDate = new \DateTime($firstDate);

        $startTime = strtotime("00:00:00");
        $endTime = strtotime("23:30:00");

        define('constDate', '2020-10-01');

        return view('course.create', compact('user', 'startDate', 'endDate', 'contDate', 'startTime', 'endTime', 'firstDate'));
    }

    public function create($firstDate)
    {

        $user = auth()->user();
        $startDate = new \DateTime($firstDate);
        $endDate = new \DateTime(date('Y-m-d', strtotime($firstDate.'+6 days')));
        $contDate = new \DateTime($firstDate);

        $startTime = strtotime("00:00:00");
        $endTime = strtotime("23:30:00");

        define('constDate', '2020-10-01');

        return view('course.create', compact('user', 'startDate', 'endDate', 'contDate', 'startTime', 'endTime', 'firstDate'));
    }

    //教師端日期查詢-POST
    public function tpost(Request $request)
    {
        $firstDate = $request->input('firstDate');

        return redirect()->route('course.create', compact('firstDate'));
    }

    //教師端開課-POST
    public function open(Request $request)
    {
        $t_dates = $request->input('t_dates');

        foreach ($t_dates as $t_date) {
            Teacher::insert(['t_date' => $t_date, 't_time' => $t_date, 'booked' => '0']);
        }

        return redirect()->back()->with('status', 'Open classes successfully!');
    }

    //教師端已開課程-GET
    public function course()
    {        
        $today = date('Y-m-d');
        $user = auth()->user();

        $active_classes = Teacher::where('t_date', '>=', $today)->orderBy('t_date')->orderBy('t_time')->get();


        return view('course.teacher', compact('user', 'today', 'active_classes'));
    }

    //教師端刪除課程
    public function delete(request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');
        $name = $request->input('name');
        $id = $request->input('id');


        if ($name != null) {
            $student = DB::table('users')->where('id', $id)->first();
            $remains = $student->ticket;

            DB::table('users')->where('id', $id)->update(['ticket' => $remains + 1]);
            Teacher::where('t_date', '=', $date)->where('t_time', '=', $time)->delete();
        } else {
            Teacher::where('t_date', '=', $date)->where('t_time', '=', $time)->delete();
        }

        return redirect()->back()->with('status', 'Delete successfully!');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
