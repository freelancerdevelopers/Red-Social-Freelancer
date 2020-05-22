@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Subir imagen') }}</div>
                  @include('includes.message')
                <div class="card-body">
                    <form method="POST" action="{{route('image.save')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group row">
                            <label for="images_path_image" class="col-md-4 col-form-label text-md-right">{{ __('Imagen a publicar') }}</label>
                            <div class="col-md-6">
                                <input id="images_path_image" type="file" class="form-control{{ $errors->has('images_path_image') ? ' is-invalid' : '' }}" name="images_path_image"  required>
                                @if ($errors->has('images_path_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('images_path_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description_image" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <textarea id="description_image"  class="form-control{{ $errors->has('description_image') ? ' is-invalid' : '' }}" name="description_image"  required autofocus>
                                </textarea>
                                @if ($errors->has('description_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Publicar') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection