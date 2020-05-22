<div class="card card-bottom">
    <div class="card-header">   
      <a href="{{route('image.detail', ['id_image'=> $image->id ])}}">    
          <img class="img-circle img-nav" src="{{ Route('user.avatar',['filename' => $image->user->image]) }}" alt="imagen-perfil" title="imagen-perfil"/> 
          {{$image->user->name}} | {{ \FormatTime::LongTimeFilter($image->created_at) }}
      </a>
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
        </div>
    </div>
</div>