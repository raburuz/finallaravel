@extends('layouts.app')

@section('content')
  <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-5">
                  <img class="img-fluid rounded mb-4 mb-lg-0"
                    src= "
                    @if( $haveImage )
                        {{url('/storage/img/'.Auth::user()->image->file_name)}}
                    @else
                        {{url('/assets/images/default_user.jpg')}}
                    @endif
                    "
                    alt="fotografia {{ Auth::user()->name }}" 
                  />
                
                 <!-- Add image-->
                  <form action = "
                    @if( $haveImage )
                        {{url('image/'.Auth::user()->image->id)}}
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
                    
                    <input type="hidden" id="imageable_id" name="imageable_id" class="d-none" value="{{Auth()->user()->id}}" required>
                    <input type="hidden" id="imageable_type" name="imageable_type" class="d-none" value="user" required>
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
                    <h1 class="font-weight-light">{{ Auth::user()->name }}</h1>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Email: {{ Auth::user()->email }}</li>
                      <li class="list-group-item">Rol: {{ Auth::user()->rol }}</li>
                    </ul>
                </div>
            </div>
            <!-- Call to Action-->
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body">
                    <p class="text-white m-0">Agregar un nuevo pokemon al Pokedrex</p>
                    <a href="{{url('pokemon')}}" class="mt-2 btn btn-primary">Agregar</a>
                
                </div>
            </div>
            <!-- Content Row-->
           
            <h2 class="mt-3 mb-4">Mis Pokemons</h2>
            <a class="btn btn-dark" href="{{ route('home', $custompokeOrder['ordernicknameasc']) }}">A-Z</a>
            <a class="btn btn-dark" href="{{ route('home', $custompokeOrder['ordernicknamedesc']) }}">Z-A</a>
            <div class="row gx-4 gx-lg-5">
                
                    @foreach($custompokes as $custompoke)
                        
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
             {{ $custompokes->onEachSide(2)->links()  }}
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
                    <input type="hidden" name="pokedex_id" value="{{Auth::user()->pokedex->id}}" required/>
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
                      <input type="number" class="form-control"  name="height" id="height" min="1" max="50" step="0.1" required/>
                      <span class="input-group-text">m (1 - 50)</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="weight">Peso (kg): </label> <br>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control"  name="weight" id="weight" min="1" max="3000" step="0.1" required/>
                      <span class="input-group-text">kg (1-3000)</span>
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
      <script type="text/javascript" src="{{url('assets/js/selectImages.js')}}"> </script>
      <script type="text/javascript" src="{{url('assets/js/eventSubmit.js')}}"> </script>
      <script type="text/javascript" src="{{url('assets/js/deleteElement.js')}}"></script>
@endsection