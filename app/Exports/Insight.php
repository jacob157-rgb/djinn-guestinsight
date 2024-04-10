<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Insight implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Guest::selectRaw('ID_identity, name, address, region, birth_date, work, education, gender, type_guest, DATE_FORMAT(updated_at, "%Y-%m-%d"), DATE_FORMAT(updated_at, "%H:%i:%s")')
            ->whereDate('updated_at', '>=', $this->startDate)
            ->whereDate('updated_at', '<=', $this->endDate)
            ->get();

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['ID Identity', 'Nama', 'Alamat', 'Wilayah', 'Tanggal Lahir', 'Pekerjaan', 'Pendidikan', 'Gender', 'Jenis Tamu', 'Tanggal Masuk', 'Jam Masuk'];
    }
}
