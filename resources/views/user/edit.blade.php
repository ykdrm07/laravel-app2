@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row justify-content-center">
   <div class="col-md-8">
     <div class="card">
       <div class="card-header">{{ __('アカウント変更') }}</div>
       <div class="card-body">
         @if (count($errors) > 0)
         <div class="errors">
           <ul>
             @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
             @endforeach
           </ul>
         </div>
         @endif
         <form action="{{route('user.update', ['user' => $user->id])}}" method="POST">
           @csrf
           @method('PATCH')
           <div class="form-group">
             <label for="name">Name</label>
             <input type="text" id="name" name="name" value="{{old('name', $user->name)}}" class="form-control">
           </div>
           <div class="form-group">
             <label for="email">E-Mail</label>
             <input type="text" id="email" name="email" value="{{old('email', $user->email)}}" class="form-control">
           </div>
           <div class="form-group">
             <label for="password">Password</label>
             <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control">
           </div>
           <div class="form-group">
             <label for="password">Password Confirmation</label>
             <input type="password" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control">
           </div>
           <button type="submit" class="btn btn-primary">変更する</button>
         </form>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection