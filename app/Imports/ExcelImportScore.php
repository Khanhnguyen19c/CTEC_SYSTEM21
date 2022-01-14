<?php

namespace App\Imports;

use App\Models\Hocphan;
use App\Models\Ketquahocphan;
use App\Models\Lophocphan;
use App\Models\Sinhvien;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ExcelImportScore implements ToCollection, WithHeadingRow
{
    public $TBM;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function headingRow(): int
    {
        return 13;
    }
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $heso = 0;
            if ($row['HS11']) {
                $heso = 1;
            } else {
                $row['HS11'] = NULL;
            }
            if ($row['HS12']) {
                $heso = $heso + 1;
            } else {
                $row['HS12'] = NULL;
            }
            if ($row['HS13']) {
                $heso = $heso + 1;
            } else {
                $row['HS13'] = NULL;
            }
            if ($row['HS21']) {
                $HS21 = $row['HS21'] * 2;
                $heso = $heso + 2;
            } else {
                $row['HS21'] = NULL;
                $HS21 = 0;
            }
            if ($row['HS22']) {
                $HS22 = $row['HS22'] * 2;
                $heso = $heso + 2;
            } else {
                $row['HS22'] = NULL;
                $HS22 = 0;
            }
            if ($row['HS23']) {
                $HS23 = $row['HS23'] * 2;
                $heso = $heso + 2;
            } else {
                $row['HS23'] = NULL;
                $HS23 = 0;
            }

            $this->TBM = ($row['HS11'] + $row['HS12'] + $row['HS13'] + $HS21 + $HS22 + $HS23) / $heso;

            if (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) < 4) {
                $DAT = 0;
            } else {
                $DAT = 1;
            }

            if (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 9.1) {
                $TRUNGBINH4 = 4;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 8.5) {
                $TRUNGBINH4 = 3.7;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >=  7.8) {
                $TRUNGBINH4 = 3.3;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 7.0) {
                $TRUNGBINH4 = 3.0;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 6.5) {
                $TRUNGBINH4 = 2.7;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 6.0) {
                $TRUNGBINH4 = 2.3;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 5.5) {
                $TRUNGBINH4 = 2.0;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 5.0) {
                $TRUNGBINH4 = 1.7;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 4.5) {
                $TRUNGBINH4 = 1.3;
            } elseif (round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2) >= 4.0) {
                $TRUNGBINH4 = 1.0;
            } else {
                $TRUNGBINH4 = 0;
            }
            $HOCPHAN = Hocphan::where('MAHOCPHAN',$row['MA_HOCPHAN'])->WHERENULL('deleted_at')->first();
            $LOPHOCPHAN = Lophocphan::where('MALOPHOCPHAN',$row['MA_LOPHOCPHAN'])->WHERENULL('deleted_at')->first();
            $SINHVIEN = Sinhvien::where('MASV',$row['MASV'])->WHERENULL('deleted_at')->first();

            try {
                Ketquahocphan::create([
                    'ID_HOCPHAN' => $HOCPHAN->ID_HOCPHAN,
                    'ID_LOPHOCPHAN' => $LOPHOCPHAN->ID_LOPHOCPHAN,
                    'ID_SINHVIEN' => $SINHVIEN->ID_SINHVIEN,
                    'HS11' => $row['HS11'],
                    'HS12' => $row['HS12'],
                    'HS13' => $row['HS13'],
                    'HS21' => $row['HS21'],
                    'HS22' => $row['HS22'],
                    'HS23' => $row['HS23'],
                    'THILAN1' => $row['THILAN1'],
                    'THILAN2' => $row['THILAN2'],
                    'TBM' => round($this->TBM, 2),
                    'TRUNGBINH10' => round(($row['THILAN1'] * 0.6) + ($this->TBM * 0.4), 2),
                    'TRUNGBINH4' => $TRUNGBINH4,
                    'DAT' => $DAT,
                    'SOTIETVANGLYTHUYET' => $row['SOTIETVANGLYTHUYET'],
                    'SOTIETVANGTHUCHANH' => $row['SOTIETVANGTHUCHANH'],
                    'GHICHU' => $row['GHICHU'],
                ]);
            } catch (ModelNotFoundException) {
                return redirect()->back();
            }
        }
    }

}
