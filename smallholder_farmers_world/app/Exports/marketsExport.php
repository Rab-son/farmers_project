<?php

namespace App\Exports;


use App\Market;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class marketsExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $marketsData = Market::select('mark_name','mark_location')->orderBy('mark_id','Desc')->get();
        return $marketsData;

    }


    public function headings(): array{
    	return['Market Name','Market Location'];
    }


}
