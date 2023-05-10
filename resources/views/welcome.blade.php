<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação da API</title>
    <!-- Link para o arquivo CSS do Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mt-8 mb-4">API de controle de pagamento pelas entregas</h1>
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold mb-2">GET /api/remetente</h2>
                <p>A API de controle de pagamento pelas entregas permite obter informações atualizadas sobre as notas de um determinado remetente.</p>
            </div>
            <div class="p-4 border-b">
                <h3 class="text-lg font-bold mb-2">Parâmetros</h3>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Parâmetro</th>
                            <th class="px-4 py-2 text-left">Tipo</th>
                            <th class="px-4 py-2 text-left">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">cnpj</td>
                            <td class="border px-4 py-2">string</td>
                            <td class="border px-4 py-2">O CNPJ do remetente das notas a serem filtradas.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold mb-2">Exemplo de solicitação</h3>
                <code class="bg-gray-200 rounded-lg p-2 font-mono">
                    GET /api/remetente?cnpj=1234567890
                </code>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold mb-2">Exemplo de resposta</h3>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <pre class="text-gray-400">
                        <code>
    {
        "cnpj": "X6XXX01XXX01XX",
        "valor_total": "12000.00",
        "valor_entregue": "7800.00",
        "valor_nao_entregue": "4200.00",
        "valor_atraso": "1200.00"
    }
                        </code>
                    </pre>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold mb-2">Erros identificados</h3>
                <p class="pt-4 pb-2"><strong>404</strong> - O CNPJ não foi utilizado no como parâmetro no request.</p>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                <pre class="text-gray-400">
                        <code>
    {
        "error": "CNPJ nao informado."
    }
                        </code>
                    </pre>
                </div>
                <p class="pt-8 pb-2"><strong>404</strong> - O CNPJ utilizado não foi encontrado em nenhuma nota.</p>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <pre class="text-gray-400">
                        <code>
    {
        "error": "Nenhuma nota encontrada para o CNPJ informado."
    }
                        </code>
                    </pre>
                </div>
                <p class="pt-8 pb-2"><strong>500</strong> - A API de homologação não conseguiu responder o GET.</p>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <pre class="text-gray-400">
                        <code>
    {
        "error": "Falha na requisição da API de homologacao."
    }
                        </code>
                    </pre>
                </div>
            </div>
        </div>
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold mb-2">Teste a API</h2>
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <form action="/api/remetente" method="GET">
                        <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label for="cnpj" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cnpj">
                            CNPJ
                            </label>
                            <input type="number" name="cnpj" id="cnpj" placeholder="CNPJ" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                        </div>
                        </div>
                        <div class="flex items-center justify-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Enviar
                        </button>
                        </div>
                    </form>
                  </div>
            </div>
                

    </div>
</body>
</html>