@extends('layouts2.app')
@section('titulo','instalacion')

@section('main-content') 
<br>
<div class="row">
	<div class="col s12 m12 l12">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>FICHA TECNICA </h2>
						 </div>
						
						 <div class="row card-header sub-header">
							<div class="col s12 m12 herramienta">     
							  
							  <a href="{{url('/instalaciones/tecnico/listado')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
								 <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
							</div>  

								  
							
					</div>

                    @foreach ($instalacion as $instal)
					@foreach ($servicio as $internet)
					@foreach ($cliente as $datos)
                    
						 
					
												 
						 <div class="row cuerpo">
						 
                            <br>
                            {{-- <div class="card white">
                                <div class="card-content ">
                                    <span>Datos del cliente</span> 
                                    <br>
                                    <div class="row"> 
                                        <div class="col s12 m6 l8">
                                       
                                            <div class="input-field col s12 m6 l6">
                                                <i class="material-icons prefix">assignment</i>
                                                <input id="cliente" name="cliente"   type="Text" value="{{$datos->nombres.' '.$datos->apaterno.' '.$datos->amaterno}}" class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="cliente"> Cliente</label>
                                                <div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div>  
                                            <div class="input-field col s12 m6 l6">
                                                <i class="material-icons prefix">assignment</i>
                                                <input id="documento" name="documento"   type="Text" value=" {{$datos->nro_documento}} " class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="documento"> Documento</label>
                                                <div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div>
                                            <div class="input-field col s12 m6 l6">
                                                <i class="material-icons prefix">assignment</i>
                                                <input id="telefono" name="telefono"   type="Text" value="{{$datos->telefono1}}" class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="telefono"> Teléfono</label>
                                                <div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div>
                                            <div class="input-field col s12 m6 l6">
                                                <i class="material-icons prefix">assignment</i>
                                                <input id="telefono2" name="telefono2"   type="Text" value="{{$datos->telefono2}}" class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="telefono2"> Teléfono 2</label>
                                                <div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div>
                                            <div class="input-field col s12 m6 l6">
                                                <i class="material-icons prefix">assignment</i>
                                                <input id="correo" name="correo"   type="Text" value="{{$datos->correo}}" class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="correo"> Correo</label>
                                                <div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div>
                                        </div> 
                                            @if(!is_null($datos->longitud ))
                                            <div class="col s12 m5 l4" style="padding-left: 5px">
                                                <div class="map-card">
                                                    <div class="card">
                                                        <div class="card-image waves-effect waves-block waves-light" style="height: 18rem; width: 100%"> 

                                                            <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q={{ $datos->latitud }},{{$datos->longitud}}+(empresa)&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/">Dibuja un circulo Google Maps</a></div>

                                                        </div>
                                                        <div class="card-content">                    
                                                            <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                                                <i class="material-icons">pin_drop</i>
                                                            </a>
                                                            <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">{{$datos->direccion}}</a>
                                                            </h4> 
                                                            <p class="blog-post-content">Información de referencia del cliente</p>
                                                        </div>
                                                        <div class="card-reveal">
                                                            <span class="card-title grey-text text-darken-4">{{ $datos->apaterno.' '.$datos->amaterno.' '.$datos->nombres }} <i class="material-icons right">close</i></span>                   
                                                            
                                                            @if(!is_null($datos->direccion))
                                                            <p><i class="material-icons cyan-text text-darken-2">room</i>{{$datos->direccion}}</p>
                                                            @endif  
                                                            @if(!is_null($datos->telefono1))
                                                            <p><i class="material-icons cyan-text text-darken-2">perm_phone_msg</i> {{$datos->telefono1}}</p>
                                                            @endif  
                                                            @if(!is_null($datos->correo))
                                                            <p><i class="material-icons cyan-text text-darken-2">email</i> {{$datos->correo}}</p>   
                                                            @endif                 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif 

                                    </div>
                                                    
                                </div> 
                                
                            </div> --}} 
                            <div class="col s12 m6 l8">{{-- datos del cliente --}}
                                <div class="card white">
                                    <div class="card-content ">
                                        <span>Datos del cliente</span> 
                                        <br>
                                        <div class="row"> 
                                            <div > 
                                                <div class="input-field col s12 m6 l6">
                                                    <i class="material-icons prefix">account_box</i>
                                                    <input id="cliente" name="cliente"   type="Text" value="{{$datos->nombres.' '.$datos->apaterno.' '.$datos->amaterno}}" class="center" data-error=".error2"  readonly="readonly" >
                                                    <label for="cliente"> Cliente</label>
                                                    <div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>  
                                                <div class="input-field col s12 m6 l6">
                                                    <i class="material-icons prefix">account_box</i>
                                                    <input id="documento" name="documento"   type="Text" value=" {{$datos->nro_documento}} " class="center" data-error=".error2"  readonly="readonly" >
                                                    <label for="documento"> Documento</label>
                                                    <div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                    <i class="material-icons prefix">contact_phone</i>
                                                    <input id="telefono" name="telefono"   type="Text" value="{{$datos->telefono1}}" class="center" data-error=".error2"  readonly="readonly" >
                                                    <label for="telefono"> Teléfono</label>
                                                    <div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                    <i class="material-icons prefix">contact_phone</i>
                                                    <input id="telefono2" name="telefono2"   type="Text" value="{{$datos->telefono2}}" class="center" data-error=".error2"  readonly="readonly" >
                                                    <label for="telefono2"> Teléfono 2</label>
                                                    <div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                    <i class="material-icons prefix">contact_mail</i>
                                                    <input id="correo" name="correo"   type="Text" value="{{$datos->correo}}" class="center" data-error=".error2"  readonly="readonly" >
                                                    <label for="correo"> Correo</label>
                                                    <div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                            </div>  
    
                                        </div>
                                        <br>
                                                        
                                    </div> 
                                </div> 
                                
                            </div>
                            <div class="col s12 m6 l4"> {{-- mapa --}}
                                <div class="card white">
                                    <div class="card-content ">
                                        <span>Ubicación del servicio</span> 
                                        <br>
                                        <div class="row"> 
                                            <div {{-- class="col s12 m6 l8" --}}> 
                                                @if(!is_null($datos->longitud ))
                                            <div {{-- class="col s12 m5 l4" --}} style="padding-left: 5px">
                                                <div class="map-card">
                                                    <div class="card">
                                                        <div class="card-image waves-effect waves-block waves-light" style="height: 11rem; width: 100%"> 

                                                            <div style="width: 100%"><iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q={{ $datos->latitud }},{{$datos->longitud}}+(empresa)&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> </div>

                                                        </div>
                                                        <div class="card-content">                    
                                                            <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                                                <i class="material-icons">pin_drop</i>
                                                            </a>
                                                            <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">{{$datos->direccion}}</a>
                                                            </h4> 
                                                            <p class="blog-post-content">Información de referencia del cliente</p>
                                                        </div>
                                                        <div class="card-reveal">
                                                            <span class="card-title grey-text text-darken-4">{{ $datos->apaterno.' '.$datos->amaterno.' '.$datos->nombres }} <i class="material-icons right">close</i></span>                   
                                                            
                                                            @if(!is_null($datos->direccion))
                                                            <p><i class="material-icons cyan-text text-darken-2">room</i>{{$datos->direccion}}</p>
                                                            @endif  
                                                            @if(!is_null($datos->telefono1))
                                                            <p><i class="material-icons cyan-text text-darken-2">perm_phone_msg</i> {{$datos->telefono1}}</p>
                                                            @endif  
                                                            @if(!is_null($datos->correo))
                                                            <p><i class="material-icons cyan-text text-darken-2">email</i> {{$datos->correo}}</p>   
                                                            @endif                 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif 

                                            </div>  
    
                                        </div>
                                                        
                                    </div> 
                                </div> 

                            </div>
                            <div class="col s12 m6 l12">{{-- servicio --}}
                                <div class="card white">
                                    <div class="card-content ">
                                        <span>Datos del servicio</span> 
                                        <br>
                                        <div class="row">   
                                            <div class="input-field col s12 m6 l4">
                                                <i class="material-icons prefix">network_check</i>
                                                @php
                                                        $nombrePerfil=null;  
                                                @endphp
                                                @foreach ($perfiles as $perfil)
                                                    @if ($internet->perfil_internet==$perfil->idperfil)
                                                        @php
                                                            $nombrePerfil=$perfil->name; 
                                                        @endphp 
                                                    @endif    
                                                @endforeach
                                                <input id="perfil" name="perfil"   type="Text" value=" {{$nombrePerfil}} " class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="perfil"> Plan 
                                                </label>
                                                <div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div> 
                                            <div class="input-field col s12 m6 l4">
                                                <i class="material-icons prefix">router</i>
                                                <input id="ip" name="ip"   type="Text" value="{{$internet->ip}}" class="center" data-error=".error2"  {{-- readonly="readonly" --}} >
                                                <label for="ip"> IP</label>
                                                <div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div>  
                                            <div class="input-field col s12 m6 l4">
                                                @php
                                                   $fecha= date('d-m-Y',strtotime($instal->fecha_instalacion));
                                                @endphp
                                                <i class="material-icons prefix">today</i>
                                                <input id="fecha" name="fecha"   type="text" value="{{$fecha}}" class="center" data-error=".error2"  readonly="readonly" >
                                                <label for="fecha"> Fecha de instalación </label>
                                                <div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                            </div> 
                                        </div>                 
                                    </div> 
                                </div> 
                            </div> 
                            <div class="col s12 m6 l12">{{-- equipos --}}
                                <div class="card white">
                                    <div class="card-content ">
                                        <span>Equipos</span> 
                                        <br>
                                        <div class="row">   
                                           {{--  area --}}
                                            
                                        </div>                 
                                    </div> 
                                </div> 
                            </div> 
                            

                        </div>
                     @endforeach
                     @endforeach
                     @endforeach
					</div>
 </div>


 
@endsection

 