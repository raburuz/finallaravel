@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="col-3 col-md-2">
         <a class="btn btn-dark mb-4" href="{{ url('home') }}">Regresar</a>    
    </div>
    
    <div class="col-12 col-md-12 text-center">
         <h2>Pokedex de {{$pokedex->user->name}}</h2>    
    </div>
    
    <div class="row">
        
    @if($pokemons->isEmpty())
        Aun no hay Pokemons
    @endif
     
     
     
    @foreach($pokemons as $custompoke)
     
            <div class="col-6 col-md-4">
                <div class="card" style="width: 18rem;">
                   <div class="card" style="width: 18rem;">
                      <img src="{{url('storage/img/'.$custompoke->pokemon->image->file_name)}}" class="card-img-top" alt="imagen de {{$custompoke->nickname}}">
                      <div class="card-body">
                        <h5 class="card-title">{{$custompoke->nickname}} <span class="text-secondary" style="font-size:14px">/ {{$custompoke->pokemon->name}} </span></h5>
                        <p class="card-text">Caracteristicas de mi pokemon</p>
                        <hr>
                        <p>Altura: {{$custompoke->height}}m</p> 
                        <p>Peso: {{$custompoke->weight}}kg</p>
                        <p>Habilidad: {{$custompoke->ability->name}}</p>
                        <p>Categoria: {{$custompoke->pokemon->specie->name}}</p>
                        <p>Tipo: {{$custompoke->pokemon->type->name}}</p>
                        
                        <a class="btn btn-dark" onclick="editCustompoke( {{$custompoke}}, '{{url('custompoke')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar mi Pokemon</a>
                            
                        <a class="btn btn-dark mt-3" onclick="deleteElement( {{$custompoke->id}},'{{$custompoke->nickname}}', '{{url('custompoke')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#deleteMe">Eliminar Pokemon</a>
                      </div>
                    </div>
                </div>
            </div>
    @endforeach
  </div>
</div>


        
        
<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="name">xxx</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form id="formUpdate" action="" method="post">
            @method('PUT')
            @csrf
           
            <div class="modal-body">
                <p>Editar <span class="name">xxx</span></p> 
                <hr>
                 <div class="mb-3">
                    <input type="hidden" name="pokedex_id" value="{{$pokedex->user_id}}" required/>
                    <input type="hidden" name="pokemon_id" id="pokemon_id" value="xxx" required/>
                 </div>
                 
                <div class="mb-3">
                    <label for="nickname">Nombre Personalizado: </label> <br>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">@</span>
                      <input type="text" class="form-control" name="nickname" id="nickname" placeholder="" aria-label="Username" aria-describedby="basic-addon1" minlength="3" maxlength="255"  required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="height">Tamaño (m): </label> <br>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control"  name="height" id="height" min="1" max="100" step="0.1" required/>
                      <span class="input-group-text">m</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="weight">Peso (kg): </label> <br>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control"  name="weight" id="weight" min="1" max="1000" step="0.1" required/>
                      <span class="input-group-text">kg</span>
                    </div>
              
                </div>
                <div class="mb-3">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="specie_id">Habilidades</label>
                         <select name="ability_id" class="form-select" aria-label="Default select example" id="specie_id" required>
                         <option value="0">Asignar</option>
                          

                            @foreach($abilitys as $ability)
                            
                                 <option aria_ability="ability_id" value="{{$ability->id}}">{{$ability->name}}</option>
                              
                           @endforeach
                         </select>
                         </select>
                    </div>
              </div>
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit"class="btn btn-primary" value="Editar"/>
            </div>
       </form>
       
    
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade " id="deleteMe" tabindex="-1" aria-labelledby="exampleModalMe" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalMe"><span class="name">xxx</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Esta seguro que desea eliminar <span class="name">xxx</span>?
      </div>
      <div class="modal-footer">
          
       <form id="form" action="" method="post">
            @method('delete')
            @csrf
           
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit"class="btn btn-primary" value="aceptar"/>
            
       </form>
       
      </div>
    </div>
  </div>
</div>




@endsection
@section('js')

      
      <script type="text/javascript" src="{{url('assets/js/editCustomPoke.js')}}"> </script>
      <script type="text/javascript" src="{{url('assets/js/deleteElement.js')}}"></script>
@endsection