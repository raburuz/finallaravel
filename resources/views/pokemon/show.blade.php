@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center">
    <h5 class="text-center">Plantilla de pokemon {{$pokemon->name}} </h5> <br>
</div>


<div class="d-flex justify-content-center">
 
    <a class="btn btn-dark" href="	{{ redirect()->getUrlGenerator()->previous() }}">Regresar</a>
</div>

<hr/>
<div class="d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
      <img src="{{url($link)}}" class="card-img-top" alt="imagen de {{$pokemon->name}}">
      <div class="card-body">
        <h5 class="card-title">{{$pokemon->name}} <span class="text-secondary" style="font-size:14px">/ Id: {{$pokemon->id}} </span></h5>
        <p class="card-text">Caracteristicas del pokemon</p>
        <hr>
        <p>Tipo: {{$pokemon->type->name}}</p> 
        <p>Especie: {{$pokemon->specie->name}}</p>
      </div>
    </div>
</div>

@endsection