<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Collection as Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cerrar(){
        //dd('entro');
        Auth::logout();

       return redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->idtipo == 'ADM') {
            //----------Contador de registro de usuarios---------------
            $tot_usuarios = 0;
            $usu_suspendidos = 0;
            $idrouter = null;
            $interface = null;

            $users = DB::table('clientes')->where('estado', 1)->get();
            $users2 = DB::table('clientes')->where('estado', 0)->get();
            $parametros = DB::table('parametros')
                ->whereIn('tipo_parametro',['DASHBOARD'])
                ->where('estado',1)->get();

            $tot_usuarios = count($users);
            $usu_suspendidos = count($users2);

            foreach ($parametros as $val) {
                if ($val->parametro == 'ROUTER_MONITOR') {
                    $idrouter = $val->valor_long;
                }
                if ($val->parametro == 'INTERFACE_MONITOR') {
                    $interface = $val->valor_long;
                }
            }

            //-----------Conexiones en Linea-------------
            $router = DB::table('router')->where('idrouter',$idrouter)->get();
            
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;
            $collection = array();
            $collection2 = array();
            $tot_conexion = 0;
            $load_cpu = 0;
            

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $ARRAY = $API->comm("/ip/hotspot/active/print");
                    $collection = Collection::make($ARRAY);      

                    $ARRAY2 = $API->comm("/ppp/active/print");
                    $collection2 = Collection::make($ARRAY2);        

                    $API->disconnect();                    
                }       

                $tot_conexion = count($collection) + count($collection2);
            }


            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $API->write("/system/resource/getall", true);
                    $READ = $API->read(false);
                    $ARRAY = $API->parse_response($READ);      

                    $API->disconnect();                    
                } 

                
                if (!is_null($ARRAY)) {
                    foreach ($ARRAY as $val) {
                        $load_cpu =   $val['cpu-load'];
                    }    
                }            
            }

            $router     = DB::table('router')->get();

            return view('home',[
                "tot_usuarios"  => $tot_usuarios,
                "usu_suspendidos"  => $usu_suspendidos,
                'tot_conexion'  => $tot_conexion,
                'load_cpu'      => $load_cpu,
                'router'        => $router,
                'idrouter'      => $idrouter,
                'interface'     => $interface
            ]);
        }else{
            $comprobantes = DB::table('factura as f')
                ->select('f.*')
                ->leftjoin('clientes as c', 'c.nro_documento', '=', 'f.idcliente')    
                ->where(['c.idcliente' => Auth::user()->idcliente])
                //->whereIn('f.idestado', ['EM','PV'])
                ->get();
            $comprobantes2 = DB::table('factura as f')
                ->select('f.*')
                ->leftjoin('clientes as c', 'c.nro_documento', '=', 'f.idcliente')    
                ->where(['c.idcliente' => Auth::user()->idcliente])
                ->whereIn('f.idestado', ['EM','PV'])
                ->get();
            $servicio = DB::table('servicio_internet as s')
                ->select('s.*')
                ->leftjoin('clientes as c', 'c.idcliente', '=', 's.idcliente')            
                ->where('c.idcliente', Auth::user()->idcliente)
                ->get();
            $interface = null;
            $forma_pagos = DB::table('forma_pagos')
                ->select('idforma_pago', 'descripcion', 'dsc_corta')
                ->where('estado', '1')
                ->get();
            $tipo_documento_venta = DB::table('documento_venta')
                ->where('estado', '1')
                ->get();
            //dd($comprobantes);

            return view('home',[
                "comprobantes"      => $comprobantes,
                "comprobantes2"     => $comprobantes2,
                'interface'         => $interface,
                'servicio'          => $servicio,
                'forma_pagos'       => $forma_pagos,
                'tipo_documento_venta'  => $tipo_documento_venta
            ]);
        }
    }

    public function monitor(){
        //dd($interface);
        $interface = $_GET["interface"]; //"<pppoe-nombreusuario>";
        $idrouter = $_GET["idrouter"];        
        $tot_conexion = 0;

        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('idrouter',$idrouter)->get();

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $rows = array(); $rows2 = array();  
                   $API->write("/interface/monitor-traffic",false);
                   $API->write("=interface=".$interface,false);  
                   $API->write("=once=",true);
                   $READ = $API->read(false);
                   $ARRAY = $API->parse_response($READ);
                    if(count($ARRAY)>0){  

                        $rx = $ARRAY[0]["rx-bits-per-second"]/1000;
                        $tx = $ARRAY[0]["tx-bits-per-second"]/1000;
                        $rows['name'] = 'Tx';
                        $rows['data'][] = $tx;
                        $rows2['name'] = 'Rx';
                        $rows2['data'][] = $rx;
                        //dd($rows,$rows2,($ARRAY[0]["rx-bits-per-second"]));

                        $API->write("/system/resource/getall", true);
                        $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ);    

                        if (!is_null($ARRAY)) {
                            foreach ($ARRAY as $val) {
                                $load_cpu =   $val['cpu-load'];
                            }    
                        }

                        //--------Usuarios Conectados------------------
                        $ARRAY = $API->comm("/ip/hotspot/active/print");
                        $collection = Collection::make($ARRAY);      

                        $ARRAY2 = $API->comm("/queue/simple/print");
                        $collection2 = Collection::make($ARRAY2);        

                        $tot_conexion = count($collection) + count($collection2);

                    }else{  
                        echo $ARRAY['!trap'][0]['message'];  
                    } 
            }else{
                echo "<font color='#ff0000'>La conexion ha fallado. Verifique si el Api esta activo.</font>";
            }
        }
        $API->disconnect();

        $result = array();
        array_push($result,$rows);
        array_push($result,$rows2);
        array_push($result,$load_cpu);
        array_push($result,$tot_conexion);
        print json_encode($result, JSON_NUMERIC_CHECK);
    }

    public function herramientaPlantilla(Request $req)
    {  
        //dd($req);

        DB::table('users')
        ->where('id',Auth::user()->id)
        ->update([
            'cabecera_color'            => $req->cabecera_color,
            'footer_color'              => $req->footer_color,
            'menu_dark'                 => (isset($req->menu_dark)? 1 : 0),
            'menu_colapsible'           => (isset($req->menu_colapsible)? 1 : 0),
            'cabecera_dark'             => (isset($req->cabecera_dark)? 1 : 0),
            'cabecera_fija'             => (isset($req->cabecera_fija)? 1 : 0),
            'cabecera_fondo_ocultar'    => (isset($req->cabecera_fondo_ocultar)? 1 : 0),
            'footer_dark'               => (isset($req->footer_dark)? 1 : 0),
            'footer_fija'               => (isset($req->footer_fija)? 1 : 0),
            'footer_ocultar'            => (isset($req->footer_ocultar)? 1 : 0) 
        ]);

        return response()->json(array('valor' => 'CONFORME'));   
        
    }
}
