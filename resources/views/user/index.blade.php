@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row justify-content-center">
   <div class="col-md-8">
     <div class="card">
       <div class="card-header">{{ __('ユーザ一覧') }}</div>
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
         <table class="table">
           <thead>
             <tr>
               <th>id</th>
               <th>ユーザ名</th>
               <th>削除</th>
             </tr>
           </thead>
           <tbody>
             @foreach ($users as $user)
               <tr>
                 <td>{{$user->id}}</td>
                 <td>{{$user->name}}</td>
                 <td>
                   @if (Auth::user()->admin_flg)
                     @if (Auth::user()->id != $user->id)
                       <a href="" class="btn btn-danger">削除</a>
                     @endif
                   @endif
                 </td>
               </tr>
             @endforeach
           </tbody>
         </table>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection