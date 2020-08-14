<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailSend;
use App\Mail\Bienvenida;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MessageFormRequest;
use DB;

class MailController extends Controller
{
    public function index()
    {  
        return view('mails.index');
    }    

    public function obtenerMensajesSalida()
    {  
            $msjs = DB::table('mensaje')
            ->select('id','enviado_por','email_destino','asunto','mensaje', 'fecha')        
            ->orderBy('fecha', 'desc')        
            ->get();

            $cont = $msjs->count();              
    
        return ['mensajes' => $msjs, 'contador' => $cont];
    }

    public function detalleSalida(Request $request, $id)
    {  
            $msj_salida = DB::table('mensaje')
            ->select('enviado_por','email_destino','asunto','mensaje', 'fecha')
            ->where('id',$id)      
            ->get()
            ->first();             

            return (['detalle_salida' => $msj_salida]);
    }

    public function visto(Request $request, $id)
    { 
           DB::table('msj_compra')
            ->where('id',$id)
            ->update(['visto' => 1]);
            return;
    }

    public function send(MessageFormRequest $request)
    {
    	$user = auth()->user();    	
    	$to = $request->to;
    	$subject = $request->subject;
    	$message = $request->message;   
        $enviado_por =  $user->nombre.' '.	$user->apellidos;    	
        DB::table('mensaje')
                ->insert([
                    'enviado_por'    => $enviado_por,
                    'email_destino'  => $to,
                    'asunto'         => $subject,
                    'mensaje'        => $message,
                    'fecha'          => date('Y-m-d H:m:s'),
                    'visto'          => '0',
                ]);

    	Mail::to($to)->send(new EmailSend($subject, $message, $user));
        return redirect('mails');
    }

     public function enviarMensaje(Request $request)
    {
        // dd($request);   
         $validatedData = $request->validate([
                'asunto'     => 'required',
                'listaDeCorreos'    => 'required',
                'contenido'  => 'required',                
            ]);
            $user = auth()->user();        
            $enviado_por =  $user->nombre.' '.  $user->apellidos; 

            $lista_correos = $request->listaDeCorreos;
            $lista_correos = implode(',', $lista_correos);            
    
             DB::table('mensaje')
                ->insert([   
                    'enviado_por'    => $enviado_por,                 
                    'email_destino'  => $lista_correos,
                    'asunto'         => $request->asunto,
                    'mensaje'        => $request->contenido,
                    'fecha'          => date('Y-m-d H:m:s')
                ]);
            // return new EnviarCampanaMail($request, $url_imagen);
           Mail::to($request->listaDeCorreos)->send(new EmailSend($request, $user));           
    }

    public function selectMultipleEmails()
    {
        $correos = DB::table('usuarios_hotspot')
            ->select('codigo', 'nombre', 'email')
            ->whereNotNull('email')
            ->get();

        return ($correos);
    }

    public function test(){
        $user = auth()->user();        

        //Mail::to($user->email)->send(new WelcomeUser($user));      
        Mail::to($user->email)->send(new Bienvenida($user));    
    }



}
