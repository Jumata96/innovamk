@extends('layouts2.app')
@section('titulo','Registrar Forma de Pagos')

@section('main-content')
<br>
<div id="app-5">
<div class="row" v-if="(seccion == 1)"> 
  <div class="col s12 m12 l12">
    <div class="card">
      <div class="card-header">                    
          <i class="fa fa-table fa-lg material-icons">receipt</i>
          <h2>Forma de Pagos</h2>
      </div>
      <div class="row card-header sub-header">
              <div class="col s12 m12">                         
              <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="viewCreate" data-position="top" data-delay="500" data-tooltip="Crear Nuevo FormaPago">
              <i class="material-icons blue-text text-darken-2">add_circle</i></button>     
              </div>                         
        </div> 
<div class="row cuerpo">                               
    <div class="col s12 m6 l6">
    Existen @{{pagination.total}} Registros.
    </div>
    <div class="col s12 m6 l6">                                    
        <div class="row rigth-align">                      
          <div class="input-field col col s12 m5 l4 right">
            <input id="busqueda" name="busqueda" type="text" class="validate" v-model="b_descripcion" @keyup="buscar(b_descripcion)">
            <label for="busqueda rigth-align">Buscar</label>                    
          </div>
        </div>         
    </div>
    <div class="card-content">
      <table class="responsive-table striped display" cellspacing="0">
         <thead>
          <tr>
             <th>#</th>
             <th>Descripci&oacute;n</th>
             <th>Abreviatura</th>
             <th>Fecha de Creaci&oacute;n</th>
             <th>Estado</th> 
             <th>Aci&oacute;n</th>                        
          </tr>
       </thead>
       <tbody>
         <tr v-for="f_pago in forma_pagos">
           <td v-text="f_pago.idforma_pago"></td>
           <td v-text="f_pago.descripcion"></td>
           <td v-text="f_pago.dsc_corta"></td>
           <td v-text="f_pago.fecha_creacion"></td>
            <td v-if="f_pago.estado == 1"><div id="estado2" class="badge green lighten-5 green-text text-accent-4 center">
              <b>ACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
            <td v-if="f_pago.estado == 2"><div id="estado" class="badge grey darken-2 white-text text-accent-5 center">
              <b>INACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
           <td>
             <a class="tooltipped" data-position="top" data-delay="500" title="Editar" v-on:click.prevent="edit(f_pago)">
             <i class="material-icons" style="color: #7986cb">visibility</i>
             </a>
             <a class="tooltipped" data-position="top" data-delay="500" title="Eliminar" v-on:click.prevent="deleteFormaPago(f_pago)">
             <i class="material-icons" style="color: #dd2c00">remove</i>
             </a>
             <a v-if="f_pago.estado == 2" class="tooltipped" data-position="top" data-delay="500" title="Habilitar" v-on:click.prevent="enableFormaPago(f_pago)">
             <i class="material-icons" style="color: #2e7d32">check</i>
             </a>
             <a v-else class="tooltipped" data-position="top" data-delay="500" title="Dehabilitar" v-on:click.prevent="disableFormaPago(f_pago)">
             <i class="material-icons" style="color: #757575">clear</i>
             </a>
            
           </td>
         </tr>
       </tbody>     
       <tfoot>
          <tr>
             <th>#</th>
             <th>Descripci&oacute;n</th>
             <th>Abreviatura</th>
             <th>Fecha de Creaci&oacute;n</th>
             <th>Estado</th> 
             <th>Aci&oacute;n</th>              
          </tr>
        </tfoot>
      </table> 
        <ul class="pagination">
        <li class="waves-effect" v-if="pagination.current_page > 1"><a href="#!" @click.prevent="changePage(pagination.current_page - 1)"><span>Atras</span></a></li>
        
        <li v-for="page in pagesNumber" :class="[ page == isActived ? 'active' : '']" ><a href="#!" @click.prevent="changePage(page)">@{{page}}</a></li>
               
        <li class="waves-effect" v-if="pagination.current_page < pagination.last_page"><a href="#!" @click.prevent="changePage(pagination.current_page + 1)"><span>Siguiente</span></a></li>
      </ul>      
    </div>
  </div>
</div>
  </div>
</div>
<div class="row" v-if="(seccion == 2)">
  <div class="col s12 m12 l12">
                 <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>CREAR NUEVO FORMA DE PAGO</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createFormaPago" data-position="top" data-delay="500" title="Guardar" v-if="(enviando == 1)">
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createFormaPago" data-position="top" data-delay="500" title="Guardar" disabled v-else>
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>                   
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-activates="dropdown2" data-position="top" data-delay="500" title="Regresar" v-on:click.prevent="(seccion = 1)">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>
                        </div>                         
                  </div>
                                    
  <div class="row">
      <div class="col s12 m12 l12">          
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos del FormaPago</span>
                          <div class="row">                     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="descripcion" name="descripcion" type="text" minlength="1" maxlength="50" v-model="descripcion">
                              <label for="descripcion">Descripci&oacute;n</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.descripcion"></div>      
                            </div>      
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="dsc_corta" name="dsc_corta" type="text" maxlength="4" v-model="dsc_corta">
                              <label for="dsc_corta">abreviatura</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.dsc_corta"></div>                            
                            </div>                                                                           
                          </div>
                        </div>
                      </div>
           
      </div>
  </div>                  
  </div>          
  </div>  
</div>

<div class="row" v-if="(seccion == 3)">
  <div class="col s12 m12 l12">
                 <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>EDITAR FORMA DE PAGO</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="UpdateFormaPago(fillFormaPago.id)" data-position="top" data-delay="500" title="Actualizar" v-if="(enviando == 1)">
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Actualizar" disabled v-else>
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>                   
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-activates="dropdown2" data-position="top" data-delay="500" title="Regresar" v-on:click.prevent="(seccion = 1)">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>
                        </div>                         
                  </div>
                                    
  <div class="row">
      <div class="col s12 m12 l12">
          
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos del FormaPago</span>
                          <div class="row">                     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="e_descripcion" name="e_descripcion" type="text" minlength="1" maxlength="50" v-model="fillFormaPago.descripcion">
                              <label for="e_descripcion" class="active">Descripción</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.descripcion"></div>                                
                            </div>      
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="e_dsc_corta" name="e_dsc_corta" type="text" maxlength="4" v-model="fillFormaPago.dsc_corta">
                              <label for="e_dsc_corta" class="active">Abreviatura</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.dsc_corta"></div>                            
                            </div>                                                                
                          </div>
                        </div>
                      </div>
           
      </div>
  </div>                  
  </div>          
  </div>  
</div>

</div>
<br><br><br><br><br>
@endsection

@section('script')
<script type="text/javascript" >

    var app5 = new Vue({      
      el: '#app-5',
      data: {
        seccion: 1,
        descripcion: '',      
        dsc_corta: '',     
        errors: '',
        enviando: '1',
        forma_pagos: [], 
        fillFormaPago: {'id': '', 'descripcion': '', 'dsc_corta': ''},
        b_descripcion: '',
        offset: 2,
        pagination: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0,
        },        
      },
      created: function () {        
        this.listFormaPagos();        
      },
      computed: {
        isActived: function(){
          return this.pagination.current_page;
        },
        pagesNumber: function(){
          if(!this.pagination.to){
            return [];
          }

          var from = this.pagination.current_page - this.offset; 
          if(from < 1){
              from = 1;
          }

          var to = from + (this.offset * 2); 
          if(to >= this.pagination.last_page){
              to = this.pagination.last_page;
          }

          var pagesArray = [];
          while(from <= to){
            pagesArray.push(from);
            from++;
          }
          return pagesArray;
        }
      },
      methods: {
        buscar: function(b_descripcion){
          if(b_descripcion == '')
          {
            this.listFormaPagos();
          }else if(b_descripcion.length >= 4){            
          var urlBuscar = 'formaPago/buscar/' + b_descripcion;
          axios.get(urlBuscar).then(response => {
              this.forma_pagos = response.data.pagos.data;
              this.pagination = response.data.pagination;
          });
          }
        },
        changePage: function(page){
          this.pagination.current_page = page;
          this.listFormaPagos(page);
        },
        listFormaPagos: function(page){
            var urlFormaPagos= 'formaPago/lista?page='+page;
            axios.get(urlFormaPagos).then(response => {                
                this.forma_pagos = response.data.pagos.data;
                this.pagination = response.data.pagination;            
            });
        },
        viewCreate: function(){
          this.seccion = 2;          
        },
        edit: function(f_pago){
          this.seccion = 3;
          this.fillFormaPago.id = f_pago.idforma_pago;
          this.fillFormaPago.descripcion = f_pago.descripcion;
          this.fillFormaPago.dsc_corta = f_pago.dsc_corta;                 
        },
        deleteFormaPago: function(f_pago){
            var url = 'formaPago/delete/' + f_pago.idforma_pago;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Forma de Pagos Eliminada</span>', 1500);
                }, 100);
                this.listFormaPagos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        disableFormaPago: function(f_pago){
            var url = 'formaPago/disable/' + f_pago.idforma_pago;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Forma de Pagos Dehabilitada</span>', 1500);
                }, 100);
                this.listFormaPagos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        enableFormaPago: function(f_pago){
            var url = 'formaPago/enable/' + f_pago.idforma_pago;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>FormaPago Habilitado</span>', 1500);
                }, 100);
                this.listFormaPagos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        UpdateFormaPago: function(id){
            var url = 'formaPago/update/' + id;
            axios.put(url, {  
                descripcion: this.fillFormaPago.descripcion,
                dsc_corta: this.fillFormaPago.dsc_corta,                     
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>FormaPago Actualizado</span>', 1500);
                }, 100);
                fillFormaPago= {'id': '', 'descripcion': '', 'dsc_corta': ''};
                this.errors = '';
                this.listFormaPagos();
                this.seccion = 1;                
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });       
        },
        createFormaPago: function() { 
            this.enviando = 0;           
            var url = 'formaPago/store';
            axios.post(url, {  
                descripcion: this.descripcion,
                dsc_corta: this.dsc_corta,                                                  
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>FormaPago Registrado</span>', 1500);
                }, 100);
                this.descripcion= '';
                this.dsc_corta= '';                           
                this.errors = '';
                this.enviando = 1;
                this.listFormaPagos();
                this.seccion = 1;
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });
        }
       }
    })   
</script>                             
@endsection
