<?php

namespace App\Exports;

use App\Models\Post;


class PostsExport extends FormCollection
{

    public function collection()
    {
        return Post::all();
    }
}
