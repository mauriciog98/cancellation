<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Old\Lesson;
use App\Models\Old\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Student $student, Request $request)
    {
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:identification,fullname,status,email']
        ]);
        $enrollment = DB::connection('old')
            ->table('enrollment')
            ->where('id_user',$student->id)
            ->where('status','activo')
            ->orderBy('id','desc')
            ->first();
        $query = Lesson::query();
        $query->where('id_enrollment', $enrollment->id);


        if ($request->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else{
            $request['field'] = 'start';
            $request['direction'] = 'desc';
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Cancellation/Lessons',[
            'items'=>$query->paginate()->withQueryString(),
            'filters'=>$request->all(['field', 'direction']),
            'student' => $student
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
