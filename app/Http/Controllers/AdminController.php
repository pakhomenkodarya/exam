<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Appointment;
class AdminController extends Controller
{
    public function index(){
        $appointments=Appointment::with('user')->latest()->get();
        return view('admin.index',compact('appointments'));
    }
    public function updateStatus(Request $request, Appointment $appointment){
    $request->validate([
    'status'=>'required',
    'reason'=>'required_if:status,Отклонена'
    ],
    [
    'status.required'=>'Укажите статус',
    'reason.required_if'=>'Укажите приину отмены'
    ]);
    $allowed=[
        'Новая'=>['Идет обучение','Отклонена'],
        'Идет обучение'=>['Обучение завершено'],
        'Обучение завершено'=>[],
        'Отклонена'=>[],
    ];
    if(!in_array($request->status,$allowed[$appointment->status])){
        return back()->with('error','недопустимый переход статуса');
    }
    $appointment->status=$request->status;
    $appointment->reason=$request->status==='Отклонена'?$request->reason:null;
    $appointment->save();
    return redirect()->route('admin.index')->with('success','Статус заявки обновлен');
    }
}
