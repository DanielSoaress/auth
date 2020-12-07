<?php

namespace App\WebService;

use SoapClient;
use App\Helpers\soapCripty;

class Student 
{
    public function autenticaAcesso($credentials)
    {
        $params = [
            'trace'             => 1,
            'exceptions'        => 0,
            'login'             => $credentials->username,
            'password'          => $credentials->password,
            'authentication'    => SOAP_AUTHENTICATION_BASIC,
        ];

        $soapClient = new \SoapClient("http://192.168.0.72:8054/wsDataServer/MEX?wsdl", $params);

        $soapClientResult = $soapClient->AutenticaAcesso();

        if (!property_exists($soapClientResult, 'faultstring')) {
            return (object) [
                'status'        => 200,
                'message'       => 'Usuário autenticado com sucesso',
                'authenticated' => $soapClientResult->AutenticaAcessoResult
            ];
        }

        return (object) [
            'status'        => 401,
            'message'       => $soapClientResult->faultstring,
            'authenticated' => 0
        ];
    }

    private function getClientSoap($kind = 1)
    {
        $data = [];
        $auth = soapCripty::catAcess();
        switch ($kind) {
            case 1:
                $url    =   "{$auth->ip}/wsConsultaSQL/MEX?wsdl";
                break;
            case 2:
                $url    =   "{$auth->ip}/wsProcess/MEX?wsdl";
                break;
            case 3:
                $url    =   "{$auth->ip}/wsConsultaSQL/MEX?wsdl";
                break;
            case 4:
                $url    =   "{$auth->ip}/wsConsultaSQL/MEX?wsdl";
                break;
        }
        try {
            $soapClient = new SoapClient($url, [
                'trace'             => 1,
                'exceptions'        => 0,
                'login'             => $auth->user,
                'password'          => $auth->password,
                'authentication'    => SOAP_AUTHENTICATION_BASIC,
            ]);
        } catch (Exception $e) {
            return [];
        }
        return $soapClient;
    }
}