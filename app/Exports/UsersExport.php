<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id','name','email')->get();
    }
    
    public function headings(): array
	{
		return [
            '#', 
            'name', 
            'email', 
        ]; 
	}

    public function title(): string{
		return 'test';
	}

    // public function collection()
    // {
    //     return User::where('id',1)->get();
    // }
}