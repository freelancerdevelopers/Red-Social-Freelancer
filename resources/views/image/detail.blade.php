@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-bottom">
                <div class="card-header">   
                   <div class="row">
                    <div class="col-md-6 text-md-left">
                        <a href="{{route('profile', ['id'=> $image->user->id ])}}">      
                         <img class="img-circle img-nav" src="{{ Route('user.avatar',['filename' => $image->user->image]) }}" alt="imagen-perfil" title="imagen-perfil"/> 
                          {{$image->user->name}} 
                        </a>| {{ \FormatTime::LongTimeFilter($image->created_at) }}
                    </div>
                    <div class="col-md-6 text-md-right">
                      @if(Auth::user() && Auth::user()->id == $image->user->id || Auth::user()->role == 'ADMINISTRATOR')  
                        <a title="eliminar publicación" href="#" data-toggle="modal" data-target="#myModal">
                            <span class="fa fa-2x fa-minus-circle delete"></span>
                        </a>
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body text-center">
                                <img src="{{ route('image.file', ['filename' => $image->images_path_image]) }}" class="img-pop" alt="{{$image->description_image}}" title="{{$image->description_image}}"/>
                                <p>Estas seguro de borrar la publicación</p>
                                <a  class="btn btn-danger"  href="{{route('image.delete', ['id' => $image->id])}}">SI Borrar</a>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>

                          </div>
                        </div>
                      @endif
                   </div>
                  </div>     
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="{{ route('image.file', ['filename' => $image->images_path_image]) }}" class="img-dashboard" alt="{{$image->description_image}}" title="{{$image->description_image}}"/>
                        </div>
                        <div class="col-md-5">
                            <div class="dv-description">
                                <small>{{'@'.$image->user->nick}}</small>
                                <p>{{$image->description_image}}</p>
                            </div>
                            <div class="row dv-controls"> 
                                <?php $user_like = false; ?>
                                @foreach ($image->likes as $like)
                                 @if( $like->user->id == Auth::user()->id )
                                    <?php $user_like = true; ?>
                                 @endif
                                @endforeach
                                @if($user_like)
                                    <div class="col-1 separator-s">
                                        <span class="fa-stack ">
                                            <a href="{{route('image.detail', ['id_image'=> $image->id ])}}">
                                                <span  data-id="{{$image->id}}" style="color:red; width: 40px; height: 40px; margin-right: 40px;" class="fa fa-stack-2x fa-heart dislike"></span>
                                            </a>    
                                        </span>
                                    </div>
                                @else
                                    <div class="col-1 separator-s">
                                       <span class="fa-stack ">
                                         <a href="{{route('image.detail', ['id_image'=> $image->id ])}}">
                                           <span  data-id="{{$image->id}}" style="color:black; width: 40px; height: 40px; margin-right: 40px;" class="fa fa-stack-2x fa-heart like"></span>
                                         </a>
                                       </span>
                                    </div>
                                @endif
                                <div class="col-1 separator-s">
                                    <span class="fa-stack">
                                        <a href="{{route('image.detail', ['id_image'=> $image->id ])}}">
                                           <span class="fa fa-stack-2x fa-comment" style="color:black; width: 40px; height: 40px; margin-right: 40px;" ></span>
                                        </a>
                                    </span>
                                </div>    
                            </div>
                            <div class="dv-description">
                                
                                <form method="POST" action="{{route('comment.save')}}">
                                    @csrf
                                    @include('includes.message')
                                    <div class="form-group row nodisplay">
                                        <label for="id_image" class="col-md-4 col-form-label text-md-right">{{ __('id_image') }}</label>
                                        <div class="col-md-6">
                                            <input id="id_image" type="text" class="form-control{{ $errors->has('id_image') ? ' is-invalid' : '' }}" name="id_image"  required value="{{$image->id}}">
                                            @if ($errors->has('id_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('id_image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="content_comment" class="col-md-12 col-form-label text-md-left">@include ('includes.avatar') @ {{Auth::user()->nick}} </label>
                                        <div class="col-md-12">
                                            <textarea id="content_comment"  class="form-control{{ $errors->has('content_comment') ? ' is-invalid' : '' }}" name="content_comment"  required autofocus>
                                            </textarea>
                                            @if ($errors->has('content_comment'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('content_comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 ">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Publicar comentario') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                @foreach($image->comments as $comment)
                                <div class="row comment">
                                    <div class="col-10">
                                     <small><b>{{'@'.$comment->user->nick}}</b> | {{ \FormatTime::LongTimeFilter($comment->created_at) }}</small>
                                     <p>"{{$comment->content_comment}}"</p>
                                    </div>
                                    <div class="col-2">
                                        @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id || Auth::user()->role == 'ADMINISTRATOR'))
                                            <a href="{{ route('comment.delete',['id' => $comment->id]) }}">
                                                <span class="fa fa-2x fa-minus-circle delete"></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 
        </div>
        
    </div>
</div>

@endsection


