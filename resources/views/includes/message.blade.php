 @if(session('message'))
                    <div class="alert alert-success">
                        <strong>Ok!</strong> {{session('message')}}
                    </div>
@endif