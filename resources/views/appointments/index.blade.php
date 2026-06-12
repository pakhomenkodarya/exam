@extends('layouts.app')
@section('title','Заявки')
@section('main')
<h2>Заявки</h2>
<div class="text-center mb-3">
    <a class="btn btn-light" href="{{route('appointments.create')}}">Создать заявку</a>
</div>
@if($appointments->count()>0)
<table class="table">
  <thead>
    <tr>
      <th>Иностранный язык</th>
      <th>Дата начала обучения</th>
      <th>Способ оплаты</th>
      <th>Статус</th>
      <th>Причина отмены</th>
      <th>Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach($appointments as $a)
    <tr>
      <th>{{$a->language}}</th>
      <th>{{$a->date}}</th>
      <th>{{$a->paymethod}}</th>
      <th>{{$a->status}}</th>
      <th>{{$a->reason??'-'}}</th>
      <th>
        
      </th>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<p class="centrp2">У вас нет заявок. <a class="a" href="{{route('appointments.create')}}">Создать первую заявку</a></p>
@endif
@endsection