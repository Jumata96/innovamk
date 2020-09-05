 <!-- Modal Structure -->
 <style>
  #modalPromesa .modal {
      height: 120%;
  }
</style>
 <div id="modalPromesa" class="modal modal-fixed-footer">
    <div class="card" style="position: fixed; width: 99%;">                 
      <div class="card-header">                    
        <i class="fa fa-table fa-lg material-icons">receipt</i>
        <h2>AGREGAR PROMESA </h2>
      </div>
    </div>
    <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
      <div class="col s12 m12 herramienta">                         
        <a id="addPromesaGuardar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Registrar Promesa">
          <i class="material-icons " style="color: #2E7D32">check</i></a>
        <a style="margin-left: 6px"></a>  

        <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
          <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
      </div>   
    </div> 
    <div class="modal-content"> 
      <h4></h4><br><h4></h4><br> <br>                
        <div class="row cuerpo">
          <div class="col s12 m12 l12">
              <div class="card white">
                <div class="card-content">
                  <div class="input-field col s12 m4 l6"  >
                    <input type="text" id="detalle" name="detalle"  > 
                    <label for="detalle" >Detalle</label>
                    <div id="errorPromesa1" style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>
                  {{-- <style>
                      .datepicker  {
                      position: relative; 
                      z-index: 6000;
                    }  
                  </style> --}}
                  <div class="input-field col s12 m4 l6"> {{-- style="position: fixed; width: 100%; z-index: 9" --}}
                    <input type="date" name="fechaPromesa" id="fechaPromesa"> {{-- style="position: fixed; width: 100%; z-index: 2000;"   class="datepicker" --}} 
                    <label for="fechaPromesa" >Fecha de Promesa</label>
                    <div id="errorPromesa2" style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>
                  
                  <div class="input-field col s12 m4 l6">
                    <input type="text" name="testDate1" class="datepicker">
                  </div>
                                       
              </div>
            </div>       
        </div>  
        </div> 
    </div> 
  </div>
