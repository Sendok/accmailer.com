<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\single_export;
use Illuminate\Support\Facades\DB;

class SingleExport implements FromCollection,WithHeadings
{
    use Exportable;
    public function __construct(int $req)
    {
        $this->request = $req;
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $request = $this->request;
        return single_export::where('id', $request)->get();
    }
    public function headings(): array
    {
        return [
            '#ACCID',
            'STATUS',
            'EMAIL',
            'SMTP HOST',
            'DOMAIN',
            'MX RECORD',
            'IP TARGET',
        ];
    }
}
