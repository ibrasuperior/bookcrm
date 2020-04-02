@extends('layouts.default')

@section('content')
<style>
#chart {
    max-width: 650px;
    margin: 35px auto;
}
</style>
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-dashboard">Dashboard</h1>

    <div class="ls-box ls-board-box">
        <header class="ls-info-header">
            <p class="ls-float-right ls-float-none-xs ls-small-info">Referente ao mês <strong> <?= date('m-y'); ?>
                </strong></p>
            <h2 class="ls-title-3">Resumo do Mês </h2>
        </header>

        <div id="sending-stats" class="row">
            <div class="col-sm-6 col-md-3">
                <div class="ls-box">
                    <div class="ls-box-head">
                        <h6 class="ls-title-4">Matrículas</h6>
                    </div>
                    <div class="ls-box-body">
                        <span class="ls-board-data">
                            <strong>{{ $matriculaCount }}

                            </strong>
                        </span>
                    </div>
                    <div class="ls-box-footer">
                        <a href="/matriculas" class="ls-btn ls-btn-xs">Matrículas</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="ls-box">
                    <div class="ls-box-head">
                        <h6 class="ls-title-4">Leads</h6>
                    </div>
                    <div class="ls-box-body">
                        <span class="ls-board-data">
                            <strong>{{ $leadCount }}</strong>
                        </span>
                    </div>
                    <div class="ls-box-footer">
                        <a href="/leads" class="ls-btn ls-btn-xs">Leads</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="ls-box">
                    <div class="ls-box-head">
                        <h6 class="ls-title-4">Agenda</h6>
                    </div>
                    <div class="ls-box-body">
                        <span class="ls-board-data">
                            <strong>{{$agendaCount}}</strong>
                        </span>
                    </div>
                    <div class="ls-box-footer">
                        <a href="/agenda" class="ls-btn ls-btn-xs">Agenda</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="ls-box">
                    <div class="ls-box-head">
                        <h6 class="ls-title-4 color-default"></h6>
                    </div>
                    <div class="ls-box-body">
                        <span class="ls-board-data">
                            <strong class="ls-color-theme"></strong>
                            <small></small>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        </br></br>


    </div>

    <div class="ls-box">
        <a href="https://www.ibrasuperior.com.br" class="ls-lnk-nav ls-ico-chevron-right">Site IBRA</a>
    </div>
</div>

@stop