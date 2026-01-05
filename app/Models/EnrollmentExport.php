<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnrollmentExport implements FromCollection, WithHeadings
{
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function collection()
    {
        return $this->event->enrolls->map(function ($enroll) {
            return [
                $enroll->user->name,
                $enroll->created_at,
                $enroll->payment_proof ? 'Already Paid' : 'Not yet paid',
                $enroll->attendance_timestamp ?? 'Not yet present',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Waktu Enroll',
            'Status Pembayaran',
            'Waktu Kehadiran',
        ];
    }
}
