@extends('layouts.app')

@section('content')
  <!-- Page Content-->
        <div class="container px-4 px-lg-5">
              <div class="col-3 col-md-2">
                 <a class="btn btn-dark mb-4" href="{{ url('home') }}">Regresar</a>    
            </div>
          <h2>Crear Nuevo Pokemon</h2>
           <form action="{{url('pokemon')}}" enctype="multipart/form-data" method="POST">
             @csrf
             @method('POST')
              <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" value="{{old('name') }}">
                   @if($errors->has('name'))
                        <span style="color:red">{{$errors->first('name')}}</span>
                     @endif
              </div>
              <div class="mb-3">
                <label class="form-label">Especie</label>
                 <select name="specie_id" class="form-select" aria-label="Default select example" required>
                 <option value="" selected>Asignar</option>
                    @foreach($species as $specie)
                     <option value="{{$specie->id}}">{{$specie->name}}</option>
                    @endforeach
                 </select>
                 @if($errors->has('specie_id'))
                        <span style="color:red">{{$errors->first('specie_id')}}</span>
                 @endif
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Tipo</label>
                <select name="type_id" class="form-select" aria-label="Default select example" required>
                 <option value="" selected>Asignar</option>
                    @foreach($types as $type)
                     <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                 </select>
                  @if($errors->has('type_id'))
                        <span style="color:red">{{$errors->first('type_id')}}</span>
                 @endif
              </div>
              
              <!--Image? -->
              <input type="hidden" id="imageable_type" name="imageable_type" class="d-none" value="pokemon" required>
              <input class="d-none" id="open" type="file" name="avatar" accept="image/png, image/jpeg, image/jpg" max="4096" required>
              <button type="button" class="mb-2 mt-1 btn btn-dark" onclick="clickSelectImage('open')">
                  Agregar Imagen
              </button>
               @if( $errors->has('imageable_type') || $errors->has('avatar'))
                     <br/> <span style="color:red">La imagen no ha podido subirse</span>
             @endif
              <br>
              <button type="submit" class="btn btn-primary">Crear Pokemon</button>
              
            </form>
        </div>
@endsection

@section('js')
      <script type="text/javascript" src="{{url('assets/js/selectImages.js')}}"> </script>
@endsection