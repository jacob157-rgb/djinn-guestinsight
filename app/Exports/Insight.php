<?php

namespace App\Exports;

use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
        $data = Guest::select('ID_identity', 'name', 'address', 'region', 'birth_date', 'work', 'education', 'gender', 'type_guest', 'updated_at')
            ->whereDate('updated_at', '>=', $this->startDate)
            ->whereDate('updated_at', '<=', $this->endDate)
            ->get();

        foreach ($data as $item) {
            $item->tanggal_data = $item->updated_at->format('Y-m-d');
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['ID Identity', 'Name', 'Address', 'Region', 'Birth Date', 'Work', 'Education', 'Gender', 'Type Guest', 'Tanggal Data'];
    }
}
