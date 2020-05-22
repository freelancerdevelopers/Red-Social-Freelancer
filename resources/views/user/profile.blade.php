@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-bottom">
                <div class="card-header">
                    <img class="img-circle img-profile" src="{{ Route('user.avatar',['filename' => $user->image]) }}" alt="imagen-perfil" title="imagen-perfil"/> 
                    {{$user->name}} <p>Unido desde {{ \FormatTime::LongTimeFilter($user->created_at) }}</p></div>
                <div class="card-body">                    
                    <div class="row">
                            @foreach ($user->images as $image)
                              <div class="col-sm-6 col-md-4">
                               <div class="thumbnail">
                                 <div class="card card-bottom">
                                        <div class="card-header">   
                                           <div class="row">
                                                <div class="col-md-6 text-md-left">
                                                   {{ \FormatTime::LongTimeFilter($image->created_at) }}
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
                                            <a href="{{route('image.detail', ['id_image'=> $image->id ])}}">  
                                              <img src="{{ route('image.file', ['filename' => $image->images_path_image]) }}" class="img-dashboard" alt="{{$image->description_image}}" title="{{$image->description_image}}"/>
                                            </a>
                                            <div class="dv-description">
                                                <small>{{'@'.$image->user->nick}} | {{$image->description_image}}</small>
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
                                                            <a href="{{route('home')}}">
                                                                <span  data-id="{{$image->id}}" style="color:red; width: 40px; height: 40px;" class="fa fa-stack-2x fa-heart dislike"></span>
                                                            </a>    
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="col-1 separator-s">
                                                       <span class="fa-stack ">
                                                         <a href="{{route('home')}}">
                                                           <span  data-id="{{$image->id}}" style="color:black; width: 40px; height: 40px;" class="fa fa-stack-2x fa-heart like"></span>
                                                         </a>
                                                       </span>
                                                    </div>
                                                @endif
                                               <div class="col-2 separator-s">
                                                <span class="fa-stack">
                                                    <a href="{{route('image.detail', ['id_image'=> $image->id ])}}">
                                                       <span class="fa fa-stack-2x fa-comment" style="color:black; width: 40px; height: 40px; margin-right: 40px;" ></span>
                                                    </a>
                                                </span>
                                               </div>
                                                <!--div class="col-2 separator-s">
                                                    <span class="fa-stack">
                                                        <a href="">
                                                            <span class="fa fa-stack-2x fa-bookmark" style="color:black; width: 40px; height: 40px; margin-right: 40px;" ></span>
                                                        </a>
                                                    </span>
                                                </div-->
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                               @endforeach
                           
                    </div>

                </div>
            </div>
                 
        </div>
        
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection


