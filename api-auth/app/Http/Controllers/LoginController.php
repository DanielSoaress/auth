<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Webservice\Student;
use SoapClient;


class LoginController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json("Autenticado");
        } else {
            return response()->json("Autenticação Falhou");
        }
    }

    public function authenticate2(Request $request){
        $credentials = ['username' => $request->username, 'password' => $request->password];
        
        $params = [
            'trace'             => 1,
            'exceptions'        => 0,
            'login'             => $credentials['username'],
            'password'          => $credentials['password'],
            'authentication'    => 'SOAP_AUTHENTICATION_BASIC',
        ];

        $soapClient = new SoapClient("http://192.168.0.72:8054/wsDataServer/MEX?wsdl", $params);

        $soapClientResult = $soapClient->AutenticaAcesso();

        if (!property_exists($soapClientResult, 'faultstring')) {
            return response()->json((object) [
                'status'        => 200,
                'message'       => 'Usuário autenticado com sucesso',
                'authenticated' => $soapClientResult->AutenticaAcessoResult
            ]);
        }

        return response()->json((object) [
            'status'        => 401,
            'message'       => $soapClientResult->faultstring,
            'authenticated' => 0
        ]);
    
    }
}
