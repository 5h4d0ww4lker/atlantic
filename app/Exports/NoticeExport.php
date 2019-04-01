<?php

namespace App\Exports;

use App\Notice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;


class NoticeExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Notice::all();
    }

        public function headings(): array
    {
        return [
            'Title',
            'Description',
            
        ];
    }

           public function map($notice): array
    {
        return [
            $notice->notice_title = $notice->notice_title,
            $notice->description = $notice->description,
        
        ];
    }
}
