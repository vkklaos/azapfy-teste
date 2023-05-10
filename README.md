<body>
    <h1 class="text-3xl font-bold mt-8 mb-4">Como executar a aplicação em Laravel:</h1>
     <p>1. Baixe e instale o composer: https://getcomposer.org/download/</p>
     <p>2. Clone o repositório</p>
     <p>3. Abra o console na pasta do seu projeto</p>
     <p>4. Execute: composer install</p>
     <p>5. Execute: php artisan key:generate</p>
     <p>6. Execute: php artisan serve</p>
    <br/>
    <h2 class="text-3xl font-bold mt-8 mb-4">E pronto!</h2>
    <h2 class="text-3xl font-bold mt-8 mb-4">Para acessar: https://127.0.0.1:8000</h2>
    <br/>
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
                <code class="bg-gray-200 rounded-lg p-2 font-mono">GET /api/remetente?cnpj=1234567890</code>
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
    </div>
</body>
</html>
