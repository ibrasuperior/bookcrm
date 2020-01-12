<?php

namespace App\Exports;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Matricula;
use Carbon\Carbon;

class MatriculasExport implements FromView
{
    use Exportable;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $matriculas = $this->data;
        
        return view('report.index')->with('matriculas', $matriculas);
    }
}