@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Relatório de Matrículas</h1>

    @if( session('success') )
    <div class="ls-alert-success ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('success') }}
    </div>
    @endif

    <div class="ls-box-filter">

        <form action="/relatorios/matriculas/report" class="ls-form ls-form-inline  ">
            <label class="ls-label col-md-3">
                <b class="ls-label-text">De:</b>
                <input required autocomplete="off" type="text" name="dateStart" class="datepicker"
                    placeholder="dd/mm/aaaa">
            </label>

            <label class="ls-label col-md-3">
                <b class="ls-label-text">Até:</b>
                <input autocomplete="off" type="text" name="dateEnd" class="datepicker" placeholder="dd/mm/aaaa">
            </label>


            <div class="ls-actions-btn">
                <button type="submit" class="ls-btn ls-btn-primary">Buscar</button>
                <?php $url =  \Request::fullUrl(); ?>

                @if( strstr($url, 'dateStart') == true )
                <a href="<?php echo str_replace('matriculas', 'matriculas/report',$url); ?>" class="ls-btn">
                    Exportar
                </a>
                @endif
            </div>
        </form>
    </div>

    <table class="ls-md-space ls-table  ls-bg-header ">
        <thead>
            <tr>
                <th class="ls-txt-center"></th>
                <th class="ls-txt-center">
                    + um Lead @if( !empty($data)) <br> {{ $data['comercial1']['equipe'] }}
                    Operadores @endif
                </th>
                <th class="ls-txt-center">
                    Linha de Frente @if( !empty($data)) <br> {{ $data['comercial2']['equipe'] }}
                    Operadores @endif
                </th>
                <th class="ls-txt-center">
                    Audácia @if( !empty($data)) <br> {{ $data['comercial3']['equipe'] }}
                    Operadores @endif
                </th>
                <th class="ls-txt-center">
                    Maníacos @if( !empty($data)) <br> {{ $data['comercial4']['equipe'] }}
                    Operadores @endif
                </th>
            </tr>
        </thead>

        @if( !empty($data))

        <tbody>

            <tr>
                <td class="ls-txt-center"><strong>Total de Matrículas</strong></td>
                <td class="ls-txt-center"> {{ $data['comercial1']['total'] }} </td>
                <td class="ls-txt-center"> {{ $data['comercial2']['total'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial3']['total'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial4']['total'] }}</td>
            </tr>
            <tr>
                <td class="ls-txt-center"><strong>Pós-Graduação</strong></td>
                <td class="ls-txt-center">{{ $data['comercial1']['pos'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial2']['pos'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial3']['pos'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial4']['pos'] }}</td>
            </tr>
            <tr style="color: blue;">
                <td class="ls-txt-center"><strong>Capacitação</strong></td>
                <td class="ls-txt-center">{{ $data['comercial1']['cap'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial2']['cap'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial3']['cap'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial4']['cap'] }}</td>
            </tr>
            <tr>
                <td class="ls-txt-center"><strong>Complementação</strong></td>
                <td class="ls-txt-center">{{ $data['comercial1']['complementacao'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial2']['complementacao'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial3']['complementacao'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial4']['complementacao'] }}</td>
            </tr>
            <tr style="background-color:#efefef;color: #800;">
                <td class="ls-txt-center"><strong>Total</strong></td>
                <td class="ls-txt-center">{{ $data['comercial1']['total-geral'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial2']['total-geral'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial3']['total-geral'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial4']['total-geral'] }}</td>
            </tr>
            <tr>
                <td class="ls-txt-center"><strong>Recebidos</strong></td>
                <td class="ls-txt-center">{{ $data['comercial1']['pago'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial2']['pago'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial3']['pago'] }}</td>
                <td class="ls-txt-center">{{ $data['comercial4']['pago'] }}</td>
            </tr>
            <tr>
                <td class="ls-txt-center"><strong>Média</strong></td>
                <td class="ls-txt-center"> {{ round( $data['comercial1']['media'], 2)  }}</td>
                <td class="ls-txt-center">{{ round( $data['comercial2']['media'], 2)  }}</td>
                <td class="ls-txt-center">{{ round( $data['comercial3']['media'], 2)  }}</td>
                <td class="ls-txt-center">{{ round( $data['comercial4']['media'], 2)  }}</td>
            </tr>
            <tr>
                <td class="ls-txt-center"><strong>Meta</strong></td>
                <td class="ls-txt-center">
                    {{ $data['comercial1']['total-geral'] }} / {{ $data['comercial1']['meta'] }}
                    <br>
                    <span style="color: red;"> Faltam {{$data['comercial1']['restante']  }}</span>
                </td>
                <td class="ls-txt-center">
                    {{ $data['comercial2']['total-geral'] }} / {{ $data['comercial2']['meta'] }}
                    <br>
                    <span style="color: red;"> Faltam {{$data['comercial2']['restante']  }}</span>
                </td>
                <td class="ls-txt-center">
                    {{ $data['comercial3']['total-geral'] }} / {{ $data['comercial3']['meta'] }}
                    <br>
                    <span style="color: red;"> Faltam {{$data['comercial3']['restante']  }}</span>
                </td>
                <td class="ls-txt-center">
                    {{ $data['comercial4']['total-geral'] }} / {{ $data['comercial4']['meta'] }}
                    <br>
                    <span style="color: red;"> Faltam {{$data['comercial4']['restante']  }}</span>
                </td>
            </tr>

        </tbody>
        @endif
    </table>



</div>




@stop