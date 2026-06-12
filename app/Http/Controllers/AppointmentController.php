<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(){
        $appointments=Appointment::where('user_id',Auth::id())->latest()->get();
        return view('appointments.index',compact('appointments'));
    }
    public function create(){
        return view('appointments.create');
    }
    public function store(Request $request){
    $data=$request->validate([
        'language'=>'required|',
        'date'=>'required|date',
        'paymethod'=>'required',
    ],[
     'language.required'=>'Укажите иностранный язык',
    'date.required'=>'Укажите удобную дату начала обучения',
    'date.date'=>'Неверный формат даты',
    'paymethod.required'=>'Укажите способ оплаты',
    ]);
    $appointment=Appointment::create([
        'user_id'=>Auth::id(),
        'language'=>$data['language'],
        'date'=>$data['date'],
        'paymethod'=>$data['paymethod'],
        'status'=>'Новая',
    ]);
    return redirect()->route('appointments.index')->with('success','Заявка создана');
    }
    public function edit($id){
        $appointment=Appointment::where('user_id',Auth::id())->findOrFail($id);
        return view('appointments.edit',compact('appointment'));
    }
    public function update(Request $request, $id){
    $appointment=Appointment::where('user_id',Auth::id())->findOrFail($id);
    $data=$request->validate([
        'language'=>'required|',
        'date'=>'required|date',
        'paymethod'=>'required',
    ],[
     'language.required'=>'Укажите иностранный язык',
    'date.required'=>'Укажите удобную дату начала обучения',
    'date.date'=>'Неверный формат даты',
    'paymethod.required'=>'Укажите способ оплаты',
    ]);
    $appointment->update([
        'language'=>$data['language'],
        'date'=>$data['date'],
        'paymethod'=>$data['paymethod'],
        'status'=>'Новая',
    ]);
    return redirect()->route('appointments.index')->with('success','Заявка обновлена');
    }
    public function delete($id){
       $appointment=Appointment::where('user_id',Auth::id())->findOrFail($id)->delete();
       return redirect()->route('appointments.index')->with('success','Заявка удалена');
    }
}
