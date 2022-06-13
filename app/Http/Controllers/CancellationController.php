<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Old\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Lesson $booking)
    {
        DB::connection('old')
            ->table('classattendance')
            ->where('id_booking',$booking->id)
            ->delete();
        DB::connection('old')
            ->table('booking')
            ->where('id',$booking->id)
            ->delete();
        DB::connection('old')
            ->table('available')
            ->where('id',$booking->id_available)
            ->decrement('reserved');
        return redirect()->back()->with('notification', [
            'message'=>'Registros eliminados'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Lesson $booking)
    {
        $status = $booking->status == 'attended' ? 'not attended': 'attended';
        DB::connection('old')
            ->table('classattendance')
            ->updateOrInsert(
                ['id_available'=>$booking->id_available, 'id_booking'=>$booking->id],
                ['status'=>$status]
            );
        return redirect()->back()->with('notification', [
            'message'=>'Registro actualizado'
        ]);
    }

}
