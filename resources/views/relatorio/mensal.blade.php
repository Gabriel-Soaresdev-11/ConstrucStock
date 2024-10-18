<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório Mensal</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid black; text-align: left; }
    </style>
</head>
<body>
    <h1>Relatório Mensal</h1>
    <p>Período: {{ \Carbon\Carbon::now()->startOfMonth()->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->endOfMonth()->format('d/m/Y') }}</p>

    <h2>Vendas Realizadas</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade Vendida</th>
                <th>Valor Total</th>
                <th>Data da Venda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
            <tr>
                <td>{{ $venda->produto->nome }}</td>
                <td>{{ $venda->quantidade }}</td>
                <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Vendido: R$ {{ number_format($totalVendido, 2, ',', '.') }}</h3>

    @if ($totalComprado > 0)
    <h2>Compras Realizadas</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Valor da Compra</th>
                <th>Data da Compra</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
            <tr>
                <td>{{ $compra->produto->nome }}</td>
                <td>R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</td>
                <td>{{ $compra->data_compra->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total Comprado: R$ {{ number_format($totalComprado, 2, ',', '.') }}</h3>
    @endif
</body>
</html>
