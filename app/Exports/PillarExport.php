<?php

namespace App\Exports;

use App\Models\PillarInformation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PillarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PillarInformation::with('category')
            ->get()
            ->map(function ($pillar) {
                return [
                    $pillar->category->category_name ?? '',
                    $pillar->plan_number,
                    $pillar->plan_document,
                    $pillar->name,
                    $pillar->unit,
                    $pillar->location,
                    $pillar->survey,
                    $pillar->pillar_number,
                    $pillar->eastings,
                    $pillar->northings,
                    $pillar->origin,
                    $pillar->height,
                    $pillar->remarks,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Category',
            'Plan Number',
             'Plan Document',
            'Name',
            'Unit',
            'Location',
            'Survey',
            'Pillar Number',
            'Eastings',
            'Northings',
            'Origin',
            'Height',
            'Remarks',
        ];
    }
}