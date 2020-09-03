<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;

class InstalacionesController extends Controller
{
    //
    public function index(){ 
        $instalacion  =DB::table('instalacion')->get();
        $clientes  =DB::table('clientes')->get();
        $tecnicos  =DB::table('tecnicos')->get(); 

        return view('forms.instalaciones.lstInstalaciones',[
            'instalacion'   =>$instalacion,
            'tecnicos'      =>$tecnicos, 
            'clientes'      =>$clientes

        ]);
    }
    public function instalacionesPorTecnico (){ 

        /* $usuariosTec  =DB::table('tecnicos')->join('users','tecnicos.usuario_cpanel','=','users.usuario') 
        ->where('users.id', strval(Auth::user()->id))
        ->get();
        dd($usuariosTec); */
        
        $usuarioPanel;
        $tecnicoId; 
        $usuarios  =DB::table('users')->where('id', strval(Auth::user()->id))->get();
        foreach( $usuarios as $usu){
            $usuarioPanel=$usu->usuario;
        } 
        $tecnicos  =DB::table('tecnicos')
        ->where('usuario_cpanel',$usuarioPanel)
        ->get();
        foreach( $tecnicos as $tec){
            $tecnicoId=$tec->idtecnico;
        } 

        $instalacion  =DB::table('instalacion')
        ->where('id_tecnico', strval($tecnicoId))
        ->get();
        // dd($instalacion );
        
        $clientes  =DB::table('clientes')->get();
        $tecnicos  =DB::table('tecnicos')->get(); 

        return view('forms.instalaciones.formTecnicos.lstInstalaciones',[
            'instalacion'   =>$instalacion,
            'tecnicos'      =>$tecnicos, 
            'clientes'      =>$clientes

        ]);


    }

    public function show_tecnicos ($id){  
        $idServicio=null;
        $idCliente=null;
        $instalacion  =DB::table('instalacion') 
        ->where('id_instalacion',$id)
        ->get();
        
        foreach( $instalacion as $insta){
            $idServicio=$insta->id_servicio;
            $idCliente=$insta->id_cliente;
        } 

        $servicio  =DB::table('servicio_internet')
        ->where('idservicio',$idServicio)
        ->get();

        $cliente = DB::table('clientes')
        ->where('idcliente',$idCliente)
        ->get();
        $perfiles = DB::table('perfiles') 
        ->get();
        // dd($servicio,$cliente);
        
        return view('forms.instalaciones.formTecnicos.updInstalacion',[
            'instalacion' =>$instalacion,
            'servicio' =>$servicio,
            'perfiles' =>$perfiles,
            'cliente' =>$cliente
        ]);
    }


    
}
