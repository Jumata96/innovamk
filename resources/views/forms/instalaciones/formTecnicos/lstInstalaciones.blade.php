@extends('layouts2.app')
@section('titulo','instalaciones')

@section('main-content') 

<div class="row">
	<div class="col s12 m12 l12">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE INSTALACIONES</h2>
						 </div>
						
						 <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
								 <div class="col s12 m12">
									 
									<a style="margin-left: 6px"></a>                          
																			  
								 </div>  
								 @include('forms.scripts.modalInformacion')   
						 </div>
												 
						 <div class="row cuerpo">
							<?php 
 
							  $bandera = false;
 
							  if (count($instalacion) > 0) {
								 # code...
								 $bandera = true;
								 $i = 0;
							  }
 
							?>
 
							<br>
							<div class="row">
								<div class="col s12 m12 l12">
								
									<div class="card-content">
										Existen <?php echo ($bandera)? count($instalacion) : 0; ?> registros. <br><br>
										<table id="data-table-simple" class="responsive-table display" cellspacing="0">
											<thead>
												<tr>
													<th>#</th> 
													<th>Cliente</th>
													<th>Dirección</th>
													<th>Responsable</th> 
													<th>Fecha instalación</th>
													<th>Estado</th>
													<th>Acción</th>
												</tr>
											</thead>
											<?php
													if($bandera){                                                           
												?>
											<tfoot>
												<tr>
													<th>#</th> 
													<th>Cliente</th>
													<th>Dirección</th>
													<th>Responsable</th>
													<th>Fecha instalación</th>
													<th>Estado</th>
													<th>Acción</th>
												</tr>
												</tfoot>
									
	
											<tbody>
												<tr>
												<?php 
														foreach ($instalacion as $datos) {
														$i++;
														$e=0;
														
													?>
													<td><?php echo $i; ?></td>
														
													<td> {{-- {{ $datos->id_cliente}} --}}
														@foreach ($clientes as $item)
														@if ($item->idcliente ==$datos->id_cliente)
															{{$item->razon_social}}
															
														@endif
															
														@endforeach
													
													</td>
													<td>{{ $datos->direccion}} </td>
													<td> 
														@foreach ($tecnicos as $Tec)
														@if ($Tec->idtecnico ==$datos->id_tecnico)
															{{$Tec->nombre." ".$Tec->apaterno."".$Tec->amaterno }} 
															
														@endif
															
														@endforeach
														
													</td> 
													<td> {{ $datos->fecha_instalacion}}</td>
													 
													<td>
															@if($datos->estado == 0)
															<div id="u_estado" class="chip center-align" style="width: 70%">
																	<b>NO DISPONIBLE</b>
																<i class="material-icons"></i>
															</div>
															@else
															<div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
																<b>ACTIVO</b>
																<i class="material-icons"></i>
															</div>
															@endif
													</td>
													<td class="center" style="width: 9rem">
														<a href="{{ url('/instalaciones/tecnicos/mostrar') }}/{{$datos->id_instalacion}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
														<i class="material-icons" style="color: #7986cb ">visibility</i>
														</a>                                       
														<a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
														<i class="material-icons" style="color: #dd2c00">remove</i>
														</a>
														@if($datos->estado == 1)                                      
														<a href="#h_confirmacion2{{$datos->id_instalacion}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
														<i class="material-icons" style="color: #757575 ">clear</i></a>
														@else
														<a href="#h_confirmacion3{{$datos->id_instalacion}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
														<i class="material-icons" style="color: #2e7d32 ">check</i></a>
														@endif
													</td>
												</tr> 
												{{-- @include('forms.zonas.scripts.alertaConfirmacion')
												@include('forms.zonas.scripts.alertaConfirmacion2') 
												@include('forms.zonas.scripts.alertaConfirmacion3')  --}}

												<?php }} ?>
											</tbody>
										</table>
										</div>
								
								</div> 
							</div>
					    </div>
					</div>
 </div>


 
@endsection

 
