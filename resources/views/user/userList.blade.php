@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.message')
            <div class="card card-bottom">
                <div class="card-header">   
                 Lista de usuarios
                </div>
                <div class="card-body">
                    
                        
                    @foreach ($users as $user)
                    <a href="{{route('profile', ['id'=> $user->id ])}}"> 
                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-circle img-list" src="{{ Route('user.avatar',['filename' => $user->image]) }}" alt="imagen-perfil" title="imagen-perfil"/> 
                        </div>
                        <div class="col-md-5">
                            <h2>@ {{$user->nick}}</h2>
                            <h3> {{$user->name}}</h3>
                            <h4> Se unió: {{ \FormatTime::LongTimeFilter($user->created_at) }}</h4>
                        </div>
                    </div>
                    </a>
                    <hr/>
                    @endforeach
                </div>
            </div>
        </div>
         <div class="col-md-10">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection