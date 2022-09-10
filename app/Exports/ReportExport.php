<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\report_export;
use Illuminate\Support\Facades\DB;

class ReportExport implements FromCollection,WithHeadings
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
        return report_export::where('user_id', $request)->get(["email","status","validate_type","smtp_host","domain","ip_target","created_at"]);
    }
    public function headings(): array
    {
        return [
            'EMAIL',
            'STATUS',
            'VERIFICATION TYPE',
            'SMTP HOST',
            'DOMAIN',
            'IP TARGET',
            'VERIFICATION DATE'
        ];
    }
}
