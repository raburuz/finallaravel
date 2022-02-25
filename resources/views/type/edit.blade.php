@extends('layouts.app')

@section('content')
  <!-- Page Content-->
        <div class="container px-4 px-lg-5">
          <h2> Editar el Type {{$name}}</h2>
          <hr>
           <form action="{{url('type/'.$id)}}" method="POST" id="form">
             @csrf
             @method('PUT')
              <div ></div>
              <div class="mb-3 clone">
                <label class="form-label">Nombre</label>
                <input value="{{old('name', $name)}}" type="text" name="name" class="form-control" required >
                 @if($errors->has('name'))
                    <span style="color:red">{{$errors->first('name')}}</span>
                 @endif
              </div>
              <button type="submit" class="btn btn-primary">Editar</button>
              <a class="btn btn-dark" href="	{{ redirect()->getUrlGenerator()->previous() }}">Regresar</a>
            </form>
        </div>
        
        

@endsection
