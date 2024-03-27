<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Models\Post;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PostController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('warehouse', 'LIKE', "%{$query}%")->paginate(10);

        return view('admin.dashboard', compact('posts'));
    }

    public function filter(Request $request)
    {
        $query = Post::query();

        $query->when($request->filled('status'), function ($q) use ($request){
            return $q->where('status', $request->status);
        });

        $query->when($request->filled('quantity_min'), function ($q) use ($request) {
            return $q->where('quantity', '>=', $request->quantity_min);
        });

        $query->when($request->filled('quantity_max'), function ($q) use ($request) {
            return $q->where('quantity', '<=', $request->quantity_max);
        });

        $posts = $query->paginate(10);

        return view('admin.dashboard', compact('posts'));
    }

    public function process(Request $request)
    {
        $selectedPosts = $request->input('selected_posts', []);

        if (!empty($selectedPosts)) {
            Post::whereIn('id', $selectedPosts)->update(['status' => 'Processed']);
            return back()->with('success', 'Selected post was processed successfully');
        }

        return back()->with('error', 'You should pick at least one post');
    }

    public function close(Request $request)
    {

        $postId = $request->input('post_id');

        $post = Post::findOrFail($postId);

        $post->status = 'Closed';

        $post->save();

        return back()->with('success', 'Post status changed to "processed".');
    }

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
            'A1');

        $posts = Post::all()->map(function ($post) {
            return [
                $post->id, $post->warehouse, $post->city, $post->card, $post->quantity, $post->date, $post->status
            ];
        })->toArray();

        $sheet->fromArray($posts, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);

        $fileName = "posts_export.xlsx";

        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        $writer->save($temp_file);

        return response()
            ->download($temp_file, $fileName, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ])
            ->deleteFileAfterSend(true);
    }
}
