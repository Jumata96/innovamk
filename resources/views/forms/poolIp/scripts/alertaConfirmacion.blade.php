<div id="confirmacion{{$datos->codigo}}" class="modal" style="width: 500px">
                                    <div class="modal-content teal white-text">
                                      <p>Está seguro que desea eliminar este registro?</p>
                                    </div>
                                    <div class="modal-footer teal lighten-4">
                                      <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
                                      <a class="waves-effect waves-light btn-flat modal-action modal-close" id="del{{$datos->codigo}}" data-ideliminar="{{$datos->codigo}}">Aceptar</a>
                                    </div>
                                  </div>