@extends('layouts.app')
@section('title','Вход')
@section('main')
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="Alert">
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h2>Вход</h2>
<form action="{{route('login')}}" method="post">
    @csrf
  <div class="mb-3">
    <label class="form-label">Логин</label>
    <input type="text" name="login" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Пароль</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <button type="submit" class="btn btn-light">Войти</button>
</form>
<p class="centrp2">Еще не зарегистрированы? <a class="a" href="{{route('register')}}">Регистрация</a></p>
@endsection