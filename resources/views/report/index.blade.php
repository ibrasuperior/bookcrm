<table>
    <thead>
        <tr>
            <th style="background-color:#800;color:#fff;"><strong>Nome</strong></th>
            <th><strong>Canal</strong></th>
            <th><strong>Valor</strong></th>
            <th><strong>Pagamento</strong></th>
            <th><strong>Pago</strong></th>
            <th><strong>Estado</strong></th>
            <th><strong>Operador</strong></th>
            <th><strong>Produto</strong></th>
            <th><strong>Data de Venda</strong></th>
            <th><strong>Data de Vencimento</strong></th>
        </tr>
    </thead>

    <tbody>
        @foreach($matriculas as $matricula)
        <tr>
            <td>{{ $matricula->nome }}</td>
            <td>{{ $matricula->canal }}</td>
            <td>{{ $matricula->valor }}</td>
            <td>{{ $matricula->pagamento }}</td>
            <td> @if( $matricula->pago) SIM @else NÃO @endif </td>
            <td>{{ $matricula->estado }}</td>
            <td>{{ $matricula->colaborador->name }}</td>
            <td>{{ $matricula->produto }}</td>
            <td>{{ $matricula->created_at }}</td>
            <td>{{ $matricula->vencimento }}</td>
        </tr>
        @endforeach
    </tbody>
</table>