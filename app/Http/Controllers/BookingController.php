<?php

namespace App\Http\Controllers;

use App\Models\Old\Available;
use App\Models\Old\Lesson;
use App\Models\Old\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BookingController extends Controller
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
            'field' => ['in:start,name_program,name_type_class,name_classroom,max_student,reserved'],
            'id_branch' => 'nullable|numeric'
        ]);
        $enrollment = DB::connection('old')
            ->table('enrollment')
            ->where('id_user',$student->id)
            ->where('status','activo')
            ->orderBy('id','desc')
            ->first();
        $query = Available::query();

        if($request->has(['id_branch'])){
            $query->where([
                ['id_level', $enrollment->current_level],
                ['start','>',Carbon::now()->format('Y-m-d H:i:s')],
                ['id_branch',request('id_branch')]
            ]);
        }else{
            $request['id_branch'] = $enrollment->id_branch;
            $query->where([
                ['id_level', $enrollment->current_level],
                ['start','>',Carbon::now()->format('Y-m-d H:i:s')],
                ['id_branch',$enrollment->id_branch]
            ]);
        }




        if (!$request->has(['field', 'direction'])) {
            $request['field'] = 'start';
            $request['direction'] = 'asc';
        }
        $query->orderBy(request('field'), request('direction'));


        return Inertia::render('Booking/Create',[
            'items'=>$query->paginate()->withQueryString(),
            'filters'=>$request->all(['field', 'direction','id_branch']),
            'student' => $student
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function booking(Request $request)
    {
        DB::connection('old')
            ->table('booking')
            ->insert([
                'id_available' => request('id_available'),
                'id_user_student' => request('is_student'),
                'active' => 'activo',
                'delete' => 'false',
            ]);
        DB::connection('old')
            ->table('available')
            ->where('id',request('id_available'))
            ->increment('max_student');
        DB::connection('old')
            ->table('available')
            ->where('id',request('id_available'))
            ->increment('reserved');
        return redirect()->back()->with('notification', [
            'message'=>'Registros eliminados'
        ]);
    }
}
