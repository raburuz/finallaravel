@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        
           @if($errors->has('nickname') 
           || $errors->has('pokemon_id') 
           || $errors->has('pokedex_id') 
           || $errors->has('ability_id') 
           || $errors->has('height')  
           || $errors->has('weight'))
                    <span style="color:red">Algo ha ido mal al crear tu Pokemon Personalizado</span>
           @endif
        
        
        <hr>
        
    @if($pokemons->isEmpty())
        Aun no hay Pokemons
    @endif
     <a class="btn btn-dark" href="{{ url('home') }}">Regresar</a>    
     <hr>
    @foreach($pokemons as $pokemon)
    <div class="col-6 col-md-4">
        <div class="card" style="width: 18rem;">
           <div class="card" style="width: 18rem;">
              <img src="{{url('storage/img/'.$pokemon->image->file_name)}}" class="card-img-top" alt="imagen de {{$pokemon->name}}">
              <div class="card-body">
                <h5 class="card-title">{{$pokemon->name}} <span class="text-secondary" style="font-size:14px">/ Id: {{$pokemon->id}} </span></h5>
                <p class="card-text">Caracteristicas del pokemon</p>
                <hr>
                <p>Tipo: {{$pokemon->type->name}}</p> 
                <p>Categoria: {{$pokemon->specie->name}}</p>
                <a class="btn btn-dark" onclick="createCustomPoke({{$pokemon->id}},'{{$pokemon->name}}')" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar a mi Pokedrex</a>
               
                
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
       <form id="form" action="{{url('custompoke')}}" method="post">
            @method('POST')
            @csrf
           
            <div class="modal-body">
                <p>Crear Custom Pokemon a partir de <span class="name">xxx</span></p> 
                <hr>
                 <div class="mb-3">
                    <input type="hidden" name="pokedex_id" value="{{Auth::user()->pokedex->id}}" required/>
                    <input type="hidden" name="pokemon_id" value="xxx" required/>
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
                      <input type="number" class="form-control"  name="height" id="height" min="1" max="50" step="0.1" required/>
                      <span class="input-group-text">m (1 - 50)</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="weight">Peso (kg): </label> <br>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control"  name="weight" id="weight" min="1" max="3000" step="0.1" required/>
                      <span class="input-group-text">kg (1 - 3000)</span>
                    </div>
                    
                </div>
                <div class="mb-3">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="specie_id">Habilidades</label>
                         <select name="ability_id" class="form-select" aria-label="Default select example" id="specie_id" required>
                         <option value="0" selected>Asignar</option>
                            @foreach($abilitys as $ability)
                             <option value="{{$ability->id}}">{{$ability->name}}</option>
                            @endforeach
                         </select>
                    </div>
              </div>
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit"class="btn btn-primary" value="Agregar"/>
            </div>
       </form>
       
    
    </div>
  </div>
</div>

@endsection


@section('js')
<script type="text/javascript" >
    
    
const createCustomPoke = (pokemon_id, pokemon_name) => {
      
      const spans = document.querySelectorAll('.name');
      const pokemonIdInput = document.getElementsByName('pokemon_id');
      pokemonIdInput[0].value=pokemon_id;
        
      console.log(pokemonIdInput)
      spans.forEach((span) => {
            span.innerText = pokemon_name;
      });
      

};

    
</script>
@endsection