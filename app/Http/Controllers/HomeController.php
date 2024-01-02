<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

    public function ogretmenStatusTeyidi(Request $request)
    {
        if ($request->password == 'iuc') {
            session(['teacherSession' => true]);
            return redirect()->route('home')->with('success', 'Statünüz onaylandı.');
        } else {
            return redirect()->route('home')->with('error', 'Yetkiniz bulunmamaktadır.');
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = Student::withCount('experiences')->get();
        return view('home', compact('students'));
    }

    public function changeLanguage($lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
