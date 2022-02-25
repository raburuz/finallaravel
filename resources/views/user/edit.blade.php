@extends('layouts.app')

@section('content')
 <div class="container px-4 px-lg-5">
     <div class="col-3 col-md-2">
           <a class="btn btn-dark mb-4" href="{{ url('home') }}">Regresar</a>    
      </div>
   
   
  <form action="{{url('user/'.$user->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" name="name" value="{{old('name', $user->name) }}" class="form-control" id="name">
     @if($errors->has('name'))
        <span style="color:red">{{$errors->first('name')}}</span>
     @endif
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email </label>
      <input type="email" name="email" value="{{old('email', $user->email)}}" class="form-control" id="email" aria-describedby="emailHelp">
    @if($errors->has('email'))
        <span style="color:red">{{$errors->first('email')}}</span>
    @endif
    </div>
    @if(!$isNormalUser && ($numAdmins)>2)
    <div class="mb-3">
      <label for="rol" class="form-label">Rol</label>
     <select name="rol" class="form-select" aria-label="Disabled select example" >
     @foreach($roles as $role)
          @if($role == $user->rol)
              <option value="{{$role}}" selected>{{$role}}</option>
          @else
              <option value="{{$role}}" >{{$role}}</option>
          @endif
      @endforeach
    </select>
     @if($errors->has('rol'))
        <span style="color:red">{{$errors->first('rol')}}</span>
     @endif
    </div>
    @endif
    <div class="mb-3">
      <label for="password" class="form-label">Nueva Contraseña</label>
      <input type="password" name="password" class="form-control" id="password">
       <div id="emailHelp" class="form-text">Rellene si desea cambiar la contraseña</div>
         @if($errors->has('password'))
            <span style="color:red">{{$errors->first('password')}}</span>
         @endif
    </div>
    <div class="mb-3">
      <label for="password2" class="form-label">Contraseña</label>
      <input type="password" name="password2" class="form-control" id="password2">
       <div id="emailHelp" class="form-text">Para confirmar los cambios debe de introducir su contraseña</div>
         @if($errors->has('password2'))
            <span style="color:red">{{$errors->first('password2')}}</span>
         @endif
    </div>
    <button type="submit" class="btn btn-primary">Cambiar</button>
  </form>
</div>

@endsection