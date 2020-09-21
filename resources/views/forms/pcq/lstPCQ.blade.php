             
                  <div class="card-header sub-header2">
                        <div class="col s12 m12 herramienta">
                          <a href="#addPCQ" id="pcq_agregar" class="btn-floating waves-effect waves-light grey lighten-5 modal-trigger tooltipped" data-position="top" data-delay="500" data-tooltip="Nuevo perfil">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>   
                          <a href="#ivw_PCQ" id="iPcq2" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Importar perfiles"><i class="material-icons green-text text-darken-3">vertical_align_bottom</i></a>
                          <a href="#ePCQ" id="ePcq3" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Exportar perfiles"><i class="material-icons  deep-purple-text text-darken-3">vertical_align_top</i></a>
                        </div>    

                        @include('forms.pcq.addPCQ')   
                        @include('forms.pcq.updPCQ')   
                        @include('forms.pcq.importar')  
                        @include('forms.pcq.exportar')     
                              
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 
                      $bandera = false;

                      if (count($pcq) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }
                    ?>
                  <br>
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($pcq) : 0; ?> registros. <br><br>
                          <table id="tablePCQ" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Desc. Perfil</th>
                                     <th>Precio</th>
                                     <th>Target</th>                         
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Desc. Perfil</th>
                                     <th>Precio</th>
                                     <th>Target</th>                         
                                     <th>Estado</th>
                                     <th>Acciones</th>
                                  </tr>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <?php 
                                      foreach ($pcq as $valor) {
                                      $i++;
                                   ?>
                                <tr id="pcq_tr{{$valor->idperfil}}">
                                  
                                     <td><?php echo $i; ?></td>
                                     <td>
                                      @foreach($router as $rou) 
                                        @if($rou->idrouter == $valor->idrouter)
                                          {{$rou->alias}}
                                        @endif
                                      @endforeach                                       
                                      </td>
                                     <td><?php echo $valor->name ?></td>
                                     <td><?php echo $valor->precio ?></td>
                                     <td><?php echo $valor->rate_limit ?></td>
                                     <td class="center">
                                        @if($valor->estado == 0)
                                        <div class="badge grey darken-2 white-text text-accent-5 center">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @else
                                        <div class="badge green lighten-5 green-text text-accent-4 center">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>
                                     <td class="center" style="width: 9rem">
                                       <a href="#updPCQ" id="updPCQ{{$valor->idperfil}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-id="{{$valor->idperfil}}" data-idrouter="{{$valor->idrouter}}" data-name="{{$valor->name}}" data-vbajada="{{$valor->vbajada}}" data-precio="{{$valor->precio}}" data-vsubida="{{$valor->vsubida}}" data-glosa="{{$valor->glosa}}" data-idrouter="{{$valor->idrouter}}" data-estado="{{$valor->estado}}" data-dsc_perfil="{{$valor->dsc_perfil}}" data-parent1="{{$valor->parent1}}" data-parent2="{{$valor->parent2}}" data-limite_usu="{{$valor->limite_usu}}" data-prioridad="{{$valor->prioridad}}">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#pcq_confirmacion{{$valor->idperfil}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a> 
                                       @if($valor->estado == 1)                                      
                                       <a href="#pcq_confirmacion2{{$valor->idperfil}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#pcq_confirmacion3{{$valor->idperfil}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                     </td>
                                  </tr>
                                    @include('forms.pcq.scripts.alertaConfirmacion')
                                    @include('forms.pcq.scripts.alertaConfirmacion2')
                                    @include('forms.pcq.scripts.alertaConfirmacion3')
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div> <br>                   
                  </div>

                </div>


