<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
    
    public function headings(): array
	{
		return [
				'#', 
				'name', 
				'email', 
				'email_verified_at', 
				'created_at', 
				'updated_at'
			]; 
	}

    // public function collection()
    // {
    //     return User::where('id',1)->get();
    // }
}