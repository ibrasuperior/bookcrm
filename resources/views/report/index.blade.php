<table>
    <thead>
    <tr>
        <th style="background:#ccc;"><strong>Nome</strong></th>
        <th style="background:#ccc;"><strong>Operador</strong></th>
        <th style="background:#ccc;"><strong>Mídia</strong></th>
        <th style="background:#ccc;"><strong>{{ $data }}</strong></th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($leads as $lead)
        <tr>
            <td>{{ $lead->nome }}</td>
            <td>{{ $lead->colaborador->name }}</td>
            <td>{{ $lead->canal->nome }}</td>
        </tr>
    @endforeach
    </tbody>
</table>