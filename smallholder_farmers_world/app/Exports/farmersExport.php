<?php

namespace App\Exports;

use App\Farmer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class farmersExport implements WithHeadings, FromCollection
{
    /**
     * 
     * 
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $farmersData = Farmer::select('full_name','id_number','birthday_date','farmer_epa','phonenumber','farm_activity')->orderBy('id','Desc')->get();
        
        return $farmersData;

    }

    public function headings(): array{
    	return['Full Name','ID Number','Date of Birth','farmer_epa','Phone Number','Farming Activity'];
    }
}
