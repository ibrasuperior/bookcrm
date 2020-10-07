<table>
    <thead>
        <tr>
            <th><strong>Nome</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>telefone</strong></th>
            <th><strong>Canal</strong></th>
            <th><strong>Situação</strong></th>
            <th><strong>Responsavel</strong></th>
            <th><strong>Data de Criação</strong></th>
        </tr>
    </thead>

    <tbody>
        @foreach($leads as $lead)
        <tr>
            <td>{{ $lead->nome }}</td>
            <td>{{ $lead->email }}</td>
            <td>{{ $lead->telefone }}</td>
            <td>{{ $lead->canal->nome }}</td>
            <td> @if( $lead->matriculado == true) Matriculado @else Não Matriculado @endif </td>
            <td> @if($lead->colaborador_id != null) {{$lead->colaborador->name}} @endif</td>
            <td>{{ $lead->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>