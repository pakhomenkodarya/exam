@extends('layouts.app')
@section('title','Создание отзыва')
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
<h2>Создание отзыва</h2>
<form action="{{route('reviews.store',$appointment->id)}}" method="post">
    @csrf
  <div class="mb-3">
    <label class="form-label">Напишите отзыв</label>
    <input type="text" name="review" class="form-control" >
  </div>
  <button type="submit" class="btn btn-light">Отправить</button>
</form>
@endsection