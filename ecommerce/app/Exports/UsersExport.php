<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{

    private $hidden = [
        'created_at',
        'updated_at',
        'remember_token',
    ];
    public function collection()
    {
        $user = User::query()->where('status','active')->get();
        return $user;
    }

     public function map($user): array
    {
        return [
            $user->email,
            $user->name,
            $user->address,
        ];
    }


    public function headings(): array
    {
        return [
            'Email',
            'Name',
            'Address',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFF0000'],
                    ]
                ]);
            },
        ];
    }
}
