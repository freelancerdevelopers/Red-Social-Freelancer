@if (Auth::user()->image)
        <img class="img-circle img-nav" src="{{ Route('user.avatar',['filename' => Auth::user()->image]) }}" alt="imagen-perfil" title="imagen-perfil"/>
@endif