@extends('layouts.app')

@section('content')


  <div class="container px-4 px-lg-5">
      
           <div class="col-3 col-md-2">
             <a class="btn btn-dark mb-4" href="{{ url('home') }}">Regresar</a>    
            </div>
      
      
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-5">
                  <img class="img-fluid rounded mb-4 mb-lg-0"
                    src= "
                    @if( $haveImage )
                        {{url('/storage/img/'.$user->image->file_name)}}
                    @else
                        {{url('/assets/images/default_user.jpg')}}
                    @endif
                    "
                    alt="fotografia {{ $user->name }}" 
                  />
                
                 <!-- Add image-->
                  <form action = "
                    @if( $haveImage )
                        {{url('image/'.$user->image->id)}}
                    @else
                        {{url('image')}}
                    @endif
                    "  
                  enctype="multipart/form-data"  method="post">
                    @csrf
                    @if( $haveImage )
                         @method('PUT')                        
                    @else
                         @method('POST')
                    @endif
                    
                    <input type="hidden" id="imageable_id" name="imageable_id" class="d-none" value="{{$user->id}}" required>
                    <input type="hidden" id="imageable_type" name="imageable_type" class="d-none" value="user" required>
                     <input type="hidden" id="view" name="view" class="d-none" value="user/{{$user->id}}">
                    <input class="d-none" id="open" type="file" name="avatar" accept="image/png, image/jpeg, image/jpg" onChange="submit()" required>
                    <button type="button" class="mb-2 mt-1 btn btn-dark" onclick="clickSelectImage('open')">
                    @if( $haveImage )
                        Cambiar foto
                    @else
                        Agregar Foto
                    @endif
                    
                    </button>
                  </form>
                    
                  </div>
                <div class="col-lg-7">
                    <h1 class="font-weight-light">{{ $user->name }}</h1>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Email: {{ $user->email }}</li>
                      <li class="list-group-item">Rol: {{ $user->rol }}</li>
                    </ul>
                </div>
            </div>
  </div>


@endsection


@section('js')
      <script type="text/javascript" src="{{url('assets/js/selectImages.js')}}"> </script>
      <script type="text/javascript" src="{{url('assets/js/eventSubmit.js')}}"> </script>
@endsection