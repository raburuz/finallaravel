@extends('layouts.app')

@section('content')
  <!-- Page Content-->
        <div class="container px-4 px-lg-5">
             <div class="col-3 col-md-2">
                 <a class="btn btn-dark mb-4" href="{{ url('home') }}">Regresar</a>    
            </div>
            
          <h2> Agrega un nuevo tipo de pokemon</h2>
          <hr>
           <button type="button" onclick="addMoreFields()" class="mb-3 btn btn-light">Añadir más</button>
           <form action="{{url('type')}}" method="POST" id="form">
             @csrf
             @method('POST')
              <div ></div>
              <div class="mb-3 clone">
                <label class="form-label">Nombre</label>
                <input type="text" name="name[]" class="form-control" required>
                 @if($errors->has('name.*'))
                    <span style="color:red">{{$errors->first('name.*')}}</span>
                 @endif
              </div>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
        
        

@endsection

@section('js')
<script type="text/javascript" src="{{url('assets/js/cloneFields.js')}}"></script>
@endsection