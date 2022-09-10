<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\bulk_export;
use Illuminate\Support\Facades\DB;

class BulkExport implements FromCollection,WithHeadings
{
    use Exportable;
    public function __construct(string $req)
    {
        $this->request = $req;
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $request = $this->request;
        return bulk_export::where('code', $request)->get(["status","email","smtp_host","domain","ip_target","created_at"]);
    }
    public function headings(): array
    {
        return [
            'STATUS',
            'EMAIL',
            'SMTP HOST',
            'DOMAIN',
            'IP TARGET',
            'VERIFICATION DATE'
        ];
    }
}
