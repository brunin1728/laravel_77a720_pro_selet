<?php

namespace App\Helpers;
//use Response;

// Classe responsável por criar utilitários para um Json
class ResponseHelper
{
    public function __construct(){}

        // Configura e retorna uma resposta json
    public static function getResponse($titulo, $status, $corpo)
    {
        return array (
            "titulo"      => $titulo,
            "status"      => $status,
            "corpo"       => $corpo  
        );

    } // Fim do método getResponse

    // Configura e retorna um json de sucesso
    public static function getResponseSucesso($corpo) {
        return self::getResponse('sucesso', '200', $corpo);
    } // Fim do método getResponseSucesso

    // Configura e retorna um json de continue
    public static function getResponseContinue($corpo) {
        return self::getResponse('continue', '101', $corpo);
    } // Fim do método getResponseSucesso

    // Configura e retorna um json de erro
    public static function getResponseErro($corpo) {
        return self::getResponse('erro', '400', $corpo);
    } // Fim do método getResponseErro

    // Configura e retorna um json de erro de autenticacao
    public static function getResponseErroAutenticacao($corpo) {
        return self::getResponse('erro', 401, $corpo);
    } // Fim do método getResponseErroAutenticacao

    // Configura e retorna um json de erro de permissão
    public static function getResponseErroPermissao($corpo = "Seu usuário não tem permissão para acessar este serviço!")
    {
        return self::getResponse('erro', '403', $corpo);
    } // Fim do método getResponseErroAutenticacao

    public static function getResponseError($titulo, $error)
    {
        $errorsHttp = [
            '400' => 'Bad Request',
            '401' => 'Unauthorized',
            '402' => 'Payment Required',
            '403' => 'Forbidden',
            '404' => 'Not Found',
            '405' => 'Method Not Allowed',
            '406' => 'Not Acceptable',
            '407' => 'Proxy Authentication Required',
            '408' => 'Request Timeout',
            '409' => 'Conflict',
            '410' => 'Gone',
            '411' => 'Length Required',
            '412' => 'Precondition Failed',
            '413' => 'Payload Too Large',
            '414' => 'Request-URI Too Long',
            '415' => 'Unsupported Media Type',
            '416' => 'Requested Range Not Satisfiable',
            '417' => 'Expectation Failed',
            '418' => 'Im a teapot',
            '421' => 'Misdirected Request',
            '422' => 'Unprocessable Entity',
            '423' => 'Locked',
            '424' => 'Failed Dependency',
            '426' => 'Upgrade Required',
            '428' => 'Precondition Required',
            '429' => 'Too Many Requests',
            '431' => 'Request Header Fields Too Large',
            '444' => 'Connection Closed Without Response',
            '451' => 'Unavailable For Legal Reasons',
            '499' => 'Client Closed Request',
            '500' => 'Internal Server Error',
            '501' => 'Not Implemented',
            '502' => 'Bad Gateway',
            '503' => 'Service Unavailable',
            '504' => 'Gateway Timeout',
            '505' => 'HTTP Version Not Supported',
            '506' => 'Variant Also Negotiates',
            '507' => 'Insufficient Storage',
            '508' => 'Loop Detected',
            '510' => 'Not Extended',
            '511' => 'Network Authentication Required',
            '599' => 'Network Connect Timeout Error',
        ];

        return [
            "titulo"      => 'erro',
            "status"      => $error,
            "corpo"       => $errorsHttp[$error]
          ];
    }

}  // Fim da classe
