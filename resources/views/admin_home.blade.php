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
                        Cambiar foto (Max: 4mb)
                    @else
                        Agregar Foto (Max: 4mb)
                    @endif
                    
                    </button>
                    @if($errors->has('imageable_id') || $errors->has('imageable_type') || $errors->has('avatar'))
                     <br/> <span style="color:red">La imagen no ha podido subirse</span>
                     @endif
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
            <div class="card text-white bg-secondary my-5">
               <div class="p-3" id="radiosButtoms">
                 @if($canCreatePokemon)
                 <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cb_pokemons" onclick="check({pokemons:'block'}, 'pokemon')" checked>
                    <label class="form-check-label" for="cb_pokemons">
                      Pokemons
                    </label>
                  </div>
                 @else
                   <p>Para crear un pokemon debe de crear primero un Tipo y una Categoria</p>
                 @endif
                  
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cb_especies" onclick="check({especies:'block'}, 'specie')">
                    <label class="form-check-label" for="cb_especies">
                      Categorias
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cb_tipos" onclick="check({tipos:'block'}, 'type')">
                    <label class="form-check-label" for="cb_tipos">
                      Tipos
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cb_habilidades" onclick="check({habilidades:'block'}, 'ability')">
                    <label class="form-check-label" for="cb_habilidades">
                      Habilidades
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cb_usuarios" onclick="check({usuarios:'block'}, 'user')">
                    <label class="form-check-label" for="cb_usuarios">
                      Usuarios
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cb_pokedrex" onclick="check({pokedex:'block'}, 'pokedex')">
                    <label class="form-check-label" for="cb_pokedex">
                      Pokedex
                    </label>
                  </div>
               </div>
            </div>
            
            <!--Search-->
            
              <form action="{{url('search')}}" class="mt-4">
                      <h4>Busquedad</h4>
                      <div class="input-group mb-3">
                        <input type="hidden" id="mytableSearch" name="mytableSearch" value="pokemon">
                        <input type="search" name="query" class="form-control" placeholder="pikachu" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-outline-secondary" type="button">Buscar</button>
                        </div>
                      </div>
              </form>
               @isset($results)
                    <div>
                       <table class="table table-dark p-5">
                          <thead>
                            <tr>
                              <th scope="col">Posición</th>  
                              <th scope="col">Nombre</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($results as $result)
                              
                                <tr>
                                  <th scope="row">{{$loop->index+1}}</th>
                                  <td>{{$result->name}}</td>
                                </tr>
                             @endforeach
                          </tbody>
                        </table>
                    </div>
                     @endisset
             <hr>
            <!-- Content Row-->
            
             <div id="pokemons" style="display:'block'">
                @if($canCreatePokemon)
                <div class="d-flex justify-content-between"> 
                  <p class="h3">Pokemons.</p>
                  <a href="{{url('pokemon/create')}}" class="mb-2 btn btn-dark">Agregar Nuevo</a>
                </div>
               <table class="table table-dark p-5">
                  <thead>
                    <tr>
                      <th scope="col">
                       
                        Posición
                      
                      </th>    
                      <th scope="col">
                         <a href="{{ route('home', $pokemonOrder['orderidasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        #id
                          <a href="{{ route('home', $pokemonOrder['orderiddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      </th>
                      <th scope="col">Imagen</th>
                      <th scope="col">
                          <a href="{{ route('home', $pokemonOrder['ordernameasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Nombre
                          <a href="{{ route('home', $pokemonOrder['ordernamedesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                        </th>
                      <th scope="col">
                         <a href="{{ route('home', $pokemonOrder['ordertype_idasc']) }}"><i class="fas fa-arrow-down"></i></a>
                            Tipo
                          <a href="{{ route('home', $pokemonOrder['ordertype_iddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      </th>
                      <th scope="col">
                         <a href="{{ route('home', $pokemonOrder['orderspecie_idasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Especie
                          <a href="{{ route('home', $pokemonOrder['orderspecie_iddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      </th>
                      <th scope="col">-----</th>
                      <th scope="col">-----</th>
                      <th scope="col">-----</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($pokemons as $pokemon)
                      
                        <tr>
                          <th scope="row">{{$loop->index+1}}</th>
                          <td>{{$pokemon->id}}</th>
                          <td>{{$pokemon->image->file_name ?? 'Sin Imagen'}}</td>
                          <td>{{$pokemon->name}}</td>
                          <td>{{$pokemon->type->name}}</td>
                          <td>{{$pokemon->specie->name}}</td>
                          <td><a href="{{url('pokemon/'.$pokemon->id)}}">Mostrar</a></td>
                          <td><a href="{{url('pokemon/'.$pokemon->id.'/edit')}}">Editar</a></td>
                          <td><a class="text-light" onclick="deleteElement({{$pokemon->id}}, '{{$pokemon->name}}', '{{url('pokemon')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</a></td> 
                         
                        </tr>
                     @endforeach
                  </tbody>
                </table>
                <div class="d-flex">
                {{ $pokemons->onEachSide(2)->links()  }}
                </div>
                @endif
             </div> 
             
            <!-- Content Row-->
            <div id="especies" style="display:none">
                <div class="d-flex justify-content-between"> 
                  <p class="h3">Categorias.</p> 
                  <a href="{{url('specie/create')}}" class="mb-2 btn btn-dark">Agregar Nuevo</a>
                </div>
               <table class="table table-dark p-5">
                  <thead>
                    <tr>
                      <th scope="col">Posición</th>    
                      <th scope="col">
                         <a href="{{ route('home', $specieOrder['orderidasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        #id
                          <a href="{{ route('home', $specieOrder['orderiddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      </th>
                      <th scope="col">
                         <a href="{{ route('home', $specieOrder['ordernameasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Nombre
                          <a href="{{ route('home', $specieOrder['ordernamedesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      </th>
                      <th scope="col">-----</th>
                      <th scope="col">-----</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                      @foreach ($species as $specie)
                      <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$specie->id}}</th>
                        <td>{{$specie->name}}</td>
                        <td><a href="{{url('specie/'.$specie->id.'/edit')}}">Editar</a></td>
                        <td><a class="text-light" onclick="deleteElement({{$specie->id}}, '{{$specie->name}}', '{{url('specie')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</a></td> 
                      </tr>
                      @endforeach
                  </tbody>
                </table>   
                <div class="d-flex">
                {{ $species->onEachSide(2)->links()  }}
              </div>
             </div>
                 
              
          <!-- Content Row-->
          <div id="tipos" style="display:none">
            <div class="d-flex justify-content-between"> 
              <p class="h3">Tipos.</p>
              <a href="{{url('type/create')}}" class="mb-2 btn btn-dark">Agregar Nuevo</a>
            </div>
             <table class="table table-dark p-5" >
                <thead>
                  <tr>
                    <th scope="col">Posición</th>    
                    <th scope="col">
                        <a href="{{ route('home', $typeOrder['orderidasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        #id
                          <a href="{{ route('home', $typeOrder['orderiddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">
                        <a href="{{ route('home', $typeOrder['ordernameasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Nombre
                          <a href="{{ route('home', $typeOrder['ordernamedesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">-----</th>
                    <th scope="col">-----</th>
                  </tr>
                </thead>
                <tbody>
                 
                 
                    @foreach ($types as $type)
                      <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$type->id}}</th>
                        <td>{{$type->name}}</td>
                        <td><a href="{{url('type/'.$type->id.'/edit')}}">Editar</a></td>
                        <td><a class="text-light" onclick="deleteElement({{$type->id}}, '{{$type->name}}', '{{url('type')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</a></td> 
                      </tr>
                    @endforeach
                </tbody>
              </table>     
              <div class="d-flex">
                {{ $types->onEachSide(2)->links()  }}
              </div>
           </div> 
            
           <!-- Content Row-->
            <div id="habilidades" style="display:none">
              <div class="d-flex justify-content-between"> 
                <p class="h3">Habilidades.</p>
                <a href="{{url('ability/create')}}" class="mb-2 btn btn-dark">Agregar Nuevo</a>
              </div>
             <table class="table table-dark p-5">
                <thead>
                  <tr>
                    <th scope="col">Posición</th>    
                    <th scope="col">
                        <a href="{{ route('home', $abilityOrder['orderidasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        #id
                          <a href="{{ route('home', $abilityOrder['orderiddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">
                       <a href="{{ route('home', $abilityOrder['ordernameasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Nombre
                          <a href="{{ route('home', $abilityOrder['ordernamedesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">-----</th>
                    <th scope="col">-----</th>
                  </tr>
                </thead>
                <tbody>
                 
                    @foreach ($abilitys as $ability)
                      <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$ability->id}}</th>
                        <td>{{$ability->name}}</td>
                        <td><a href="{{url('ability/'.$ability->id.'/edit')}}">Editar</a></td>
                        <td><a class="text-light" onclick="deleteElement({{$ability->id}}, '{{$ability->name}}', '{{url('ability')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</a></td> 
                      </tr>

                  @endforeach
                </tbody>
              </table>  
              <div class="d-flex">
                {{ $abilitys->onEachSide(2)->links()  }}
              </div>
             </div> 
             
             
             <!-- Content Row-->
            <div id="usuarios" style="display:none">
              <div class="d-flex justify-content-between"> 
                <p class="h3">Usuarios.</p>
              </div>
             <table class="table table-dark p-5">
                <thead>
                  <tr>
                    <th scope="col">Posición</th>    
                    <th scope="col">
                       <a href="{{ route('home', $usersOrder['orderidasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        #id
                          <a href="{{ route('home', $usersOrder['orderiddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">
                       <a href="{{ route('home', $usersOrder['ordernameasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Nombre
                          <a href="{{ route('home', $usersOrder['ordernamedesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">
                       <a href="{{ route('home', $usersOrder['orderrolasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Rol
                          <a href="{{ route('home', $usersOrder['orderroldesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">
                         <a href="{{ route('home', $usersOrder['orderemailasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Email
                          <a href="{{ route('home', $usersOrder['orderemaildesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">
                       <a href="{{ route('home', $usersOrder['orderemail_verified_atasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Verificado
                          <a href="{{ route('home', $usersOrder['orderemail_verified_atdesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                    </th>
                    <th scope="col">-----</th>
                    <th scope="col">-----</th>
                    <th scope="col">-----</th>
                  </tr>
                </thead>
                <tbody>
               
                    @foreach ($users as $user)
                      <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->rol}}</td>
                        <td>{{$user->email}}</td>
                        @if($user->email_verified_at)
                        <td>Si</td>
                        @else
                         <td>No</td>
                        @endif
                        @if($user->rol != 'admin')
                          <td><a href="{{url('user/'.$user->id)}}">Mostrar</a></td>
                          <td><a href="{{url('edituser/'.$user->id.'/edit')}}">Editar</a></td>
                          <td><a class="text-light" onclick="deleteElement({{$user->id}}, '{{$user->name}}', '{{url('user')}}' )" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</a></td> 
                        @else
                          <th>-----</th>
                          <td>----</td>
                          <td>----</td>
                        @endif
                      </tr>
                    @endforeach
                </tbody>
              </table>    
              <div class="d-flex">
                {{ $users->onEachSide(2)->links()  }}
              </div>
             </div> 
             
             
             
              <!-- Content Row-->
            <div id="pokedex" style="display:none">
              <div class="d-flex justify-content-between"> 
                <p class="h3">Pokedex.</p>
              </div>
             <table class="table table-dark p-5">
                <thead>
                  <tr>
                    <th scope="col">Posición</th>    
                    <th scope="col">
                      
                       <a href="{{ route('home', $pokedexOrder['orderidasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        #id
                        <a href="{{ route('home', $pokedexOrder['orderiddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      
                    </th>
                    <th scope="col">
                      
                        <a href="{{ route('home', $pokedexOrder['orderuser_idasc']) }}"><i class="fas fa-arrow-down"></i></a>
                        Nombre de usuario
                        <a href="{{ route('home', $pokedexOrder['orderuser_iddesc']) }}"><i class="fas fa-arrow-up"></i></a>
                        
                      
                      </th>
                    <th scope="col">nº Pokemons</th>
                    <th scope="col">-----</th>
                  </tr>
                </thead>
                <tbody>
                
                    @foreach ($pokedexs as $pokedex)
                      @if($pokedex->user->rol != 'admin')
                      <tr>
                        <th scope="row">{{$loop->index}}</th>
                        <td>{{$pokedex->id}}</th>
                        <td>{{$pokedex->user->name}}</td>
                        <td>{{count($pokedex->pokemons)}}</td>
                        <td><a href="{{url('pokedex/'.$pokedex->id)}}">Mostrar</a></td>
                      </tr>
                      @endif
                    @endforeach
                </tbody>
              </table>    
              <div class="d-flex">
                {{ $pokedexs->onEachSide(2)->links()  }}
              </div>
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
      <script type="text/javascript" src="{{url('assets/js/radioButtonPanelAdmin.js')}}"></script>
      
      <script type="text/javascript" src="{{url('assets/js/selectImages.js')}}"> </script>
      <script type="text/javascript" src="{{url('assets/js/eventSubmit.js')}}"> </script>
      <script type="text/javascript" src="{{url('assets/js/deleteElement.js')}}"></script>
@endsection