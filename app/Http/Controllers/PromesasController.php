<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth; 
use Carbon\Carbon;
use DB;


class PromesasController extends Controller
{
    //
    public function store(Request $request)
    {
      
        //  dd($request);
        $rules = array(  
            'detalle'            => 'required',  
            'fechaPromesa'            => 'required',  
        );
        $validator = Validator::make ( $request->all(), $rules ); 
        if ($validator->fails()){
                $var = $validator->getMessageBag()->toarray();
                array_push($var, 'error');
                //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
                return response()->json($var);
        } 
        //--Se actualiza la factura con estado Pagado y se guarda la fecha 
        $idservicio=null;
        $idclienete=null;
        $aviso=null;
        $corte=null;
        $fecha_pago=null;
        // dd( $aviso,$corte,$fecha_pago ); 
        $factura=DB::table('factura')->where('codigo',$request->idfactura)->get();
        

        foreach($factura as $fac){
            $idservicio=$fac->idservicio;
            $idclienete=$fac->idcliente;
        }

        $notificaciones = DB::table('notificaciones')->where('idservicio', $idservicio)->get();
        foreach($notificaciones as $notificacion){
                $aviso=$notificacion->aviso;
                $corte=$notificacion->corte;

        } 
        $avisoPromesa =  date("d-m-Y",strtotime($request->fechaPromesa."+ ".$aviso." days"));
        $cortePromesa = date("d-m-Y",strtotime($request->fechaPromesa."- ".$corte." days")); 
        $fecha_pago = date("d-m-Y",strtotime($request->fechaPromesa)); 
        $fecha_validar = new \DateTime($request->fechaPromesa);
        $diaN = (int) date_format($fecha_validar,'d');
        
         

        DB::table('factura')
        ->where('codigo',$request->idfactura)
        ->update([
             /*    'idestado'           => 'EM', */ ///EM O PA   
            /*  'fecha_vencimiento'  => $fecha_pago*/
                'fecha_corte'        => $cortePromesa,
                'glosa'              => $request->detalle,//-----------actualizar esta fecha 
                'fecha_pago'         => $fecha_pago,
                'idusuario_registro_pago' => Auth::user()->id,
        ]);

        /* $servicio = DB::table('servicio_internet')
            ->where('idcliente', $idservicio)
            ->update([
                 'dia_pago'  =>$diaN    
        ]); */
        
        
         

        DB::table('servicio_internet')
        ->where('idservicio',$idservicio)
        ->update([
            'activar_notificacion'    => 0
        ]);  
       
     
               
    }
}
