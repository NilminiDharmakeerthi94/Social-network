@extends('layouts.master')
@section('title')
welcome
@endsection

@section('content')

@include('includes.message-block')

<div class="row">
<div class="col-md-6">
<h3>sign up</h3>
<form action="{{route('signup')}}" method="post">
<div class="form-group" {{ $errors->has('email') ? 'has-error' : ''}}>
<label for="email">email</label>
<input class="form-control" type="text" name="email" id="email" value= "{{ Request::old('email') }}">
</div>

<div class="form-group"  {{ $errors->has('name') ? 'has-error' : ''}}>
<label for="name">name</label>
<input class="form-control" type="text" name="name" id="name" value= "{{ Request::old('name') }}">
</div>

<div class="form-group"  {{ $errors->has('password') ? 'has-error' : ''}}>
<label for="password">password</label>
<input class="form-control" type="password" name="password" id="password" value= "{{ Request::old('password') }}">
</div>
<button type="submit" class= "btn btn-primary" >Submit</button>
<input type="hidden" name="_token" value="{{ Session::token()}}">
</form>
</div>

<div class="col-md-6">
<h3>sign in</h3>
<form action="{{route('signin')}}" method="post">
<div class="form-group" >
<label for="email">email</label>
<input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email')}}">
</div>

<div class="form-group"  >
<label for="password">password</label>
<input class="form-control" type="password" name="password" id="password" values="{{ Request::old('password')}}">
</div>
<button type="submit" class= "btn btn-primary" >Submit</button>
<input type="hidden" name="_token" value="{{ Session::token()}}">
</form>
</div>

</div>

@endsection