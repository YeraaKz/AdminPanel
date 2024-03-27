<?php

namespace App\Http\Utils;

use App\Models\Post;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PostExport
{
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            'ID',
            'Склад',
            'Город',
            'Карта',
            'Штук',
            'Дата',
            'Статус'],
            NULL,
            'A1'
        );

        $posts = Post::all()->map(function ($post) {
            return [
                $post->id,
                $post->warehouse,
                $post->city,
                $post->card,
                $post->quantity,
                $post->date,
                $post->status
            ];
        })->toArray();

        $sheet->fromArray($posts, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        $fileName = "posts_export.xlsx";
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ])->deleteFileAfterSend(true);
    }
}
