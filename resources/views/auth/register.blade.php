@extends('layouts.app')
@section('title','Регистрация')
@section('main')
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="Alert">
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<h2>Регистрация</h2>
<form action="{{route('register')}}" method="post">
    @csrf
  <div class="mb-3">
    <label class="form-label">Логин</label>
    <input type="text" name="login" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Пароль</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">ФИО</label>
    <input type="text" name="name" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Дата рождения</label>
    <input type="date" name="date" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Контактный номер телефона</label>
    <input type="tel" name="tel" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" name="email" class="form-control" >
  </div>
  <button type="submit" class="btn btn-light">Зарегистрироваться</button>
</form>
<p class="centrp2">Есть аккаунт? <a class="a" href="{{route('login')}}">Войти</a></p>
@endsection