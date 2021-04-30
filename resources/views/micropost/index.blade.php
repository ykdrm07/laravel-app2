@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">{{ __('投稿一覧') }}</div>
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
             <th>ユーザ名</th>
             <th>内容</th>
             <th>投稿日時</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($microposts as $micropost)
             <tr>
               <td>{{$micropost->user->name}}</td>
               <td>{!! nl2br(e($micropost->content)) !!}</td>
               <td>{{$micropost->created_at}}</td>
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