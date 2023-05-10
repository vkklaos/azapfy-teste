<?php

namespace App\Http\Controllers;
// GuzzleHttp para dar GET na API
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
// Exception para lidar com os erros
use Exception;
// GuzzleHttp / RequestException para lidar com erros do GuzzleHttp
use GuzzleHttp\Exception\RequestException;

use Illuminate\Http\Request;

class RemetenteController extends Controller
{

    public function index(Request $request) {
        // Lidando com o erro de não haver CNPJ no request
        if (!$request->has('cnpj')) {
            $resultado = [
                'error' => 'CNPJ nao informado.',
            ];
            return response()->json($resultado, 400);
        }
        $cnpj = $request->input('cnpj');
        try {
            // GuzzleHttp
            $client = new Client();
            $res = $client->request('GET', 'http://homologacao3.azapfy.com.br/api/ps/notas');
            $result = $res->getBody();

            // Converter o JSON para PHP Array:
            $notas = json_decode($result, true);

            // Dados a exportar:
            $total_notas = 0;
            $valor_entregue = 0;
            $valor_nao_entregue = 0;
            $valor_atraso = 0;

            // Iteração simples sobre as notas com `foreach`
            foreach ($notas as $nota) {
                if ($nota['cnpj_remete'] == $cnpj) {
                    // Converter o valor para float para realizar as operações aritméticas corretamente
                    $valor = floatval($nota['valor']);
                    $total_notas += $valor;
                    
                    if ($nota['status'] == 'COMPROVADO') {
                        // Converter a data para timestamp UNIX 
                        $dt_emis = strtotime(str_replace('/', '-', $nota['dt_emis']));
                        $dt_entrega = strtotime(str_replace('/', '-', $nota['dt_entrega']));
                        // Calculando o número de dias entre a emissão e a entrega
                        $dias_entrega = round(abs($dt_entrega - $dt_emis) / (60 * 60 * 24));
                        if ($dias_entrega <= 2) {
                            $valor_entregue += $valor;
                        } else {
                            $valor_atraso += $valor;
                        }
                    } else {
                        $valor_nao_entregue += $valor;
                    }
                }
            }

            if ($total_notas == 0) {
                // Lidando com erro de CPNJ incorreto
                throw new Exception('Nenhuma nota encontrada para o CNPJ informado.');
            }

            $resultado = [
                'cnpj' => $cnpj,
                'total_notas' => $total_notas,
                'valor_entregue' => $valor_entregue,
                'valor_nao_entregue' => $valor_nao_entregue,
                'valor_atraso' => $valor_atraso,
            ];

            return response()->json($resultado, 200);
        // Lidando com demais excessões do PHP
        } catch (Exception $e) {
            
            $resultado = [
                'error' => $e->getMessage(),
            ];
    
            return response()->json($resultado, 404);
        // Lidando com as excessões do GuzzleHttp
        } catch (RequestException $e) {
            return response()->json(['error' => 'Falha na requisição da API de homologacao.'], 500);
        }
    }
}
