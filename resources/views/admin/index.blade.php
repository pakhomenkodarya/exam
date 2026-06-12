@extends('layouts.app')
@section('title','Админ-панель')
@section('main')
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="Alert">
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert" id="closeBtn"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="Alert">
            {{session('error')}}<br>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert" id="closeBtn"></button>
    </div>
@endif
<h2>Админ-панель</h2>
@if($appointments->count()>0)
<table class="table">
  <thead>
    <tr>
        <th>Клиент</th>
      <th>Иностранный язык</th>
      <th>Дата начала обучения</th>
      <th>Способ оплаты</th>
      <th>Статус</th>
    </tr>
  </thead>
  <tbody>
    @foreach($appointments as $a)
    <tr>
    <th>{{$a->user->name}}</th>
      <th>{{$a->language}}</th>
      <th>{{$a->date}}</th>
      <th>{{$a->paymethod}}</th>
      <th ><form action="{{route('admin.updateStatus',$a)}}" method="post"class="two">
        @method('PUT')
        @csrf
        <select class="form-select" name="status" onchange="this.nextElementSibling.style.display=this.value==='Отклонена'?'block':'none'">
        <option value="Новая"{{$a->status=='Новая'?'selected':''}}>Новая</option>
        <option value="Идет обучение"{{$a->status=='Идет обучение'?'selected':''}}>Идет обучение</option>
        <option value="Обучение завершено"{{$a->status=='Обучение завершено'?'selected':''}}>Обучение завершено</option>
        <option value="Отклонена"{{$a->status=='Отклонена'?'selected':''}}>Отклонена</option>
        </select>
        <input type="text" value="{{$a->reason}}" name="reason" style="display:{{$a->status=='Отклонена'?'block':'none'}}">
    <button type="submit" class="btn btn-light">Сохранить</button>
      </form></th>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<p class="centrp2">У вас нет заявок. <a class="a" href="{{route('appointments.create')}}">Создать первую заявку</a></p>
@endif
@endsection