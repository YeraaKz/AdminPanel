<?php

namespace App\Http\Utils;

use App\Models\Post;
use Illuminate\Http\Request;

class PostFilter
{
    public function apply(Request $request)
    {
        $query = Post::query();

        $conditions = [
            'status' => function ($value) use ($query) {
                $query->where('status', $value);
            },
            'quantity_min' => function ($value) use ($query) {
                $query->where('quantity', '>=', $value);
            },
            'quantity_max' => function ($value) use ($query) {
                $query->where('quantity', '<=', $value);
            }
        ];

        foreach ($conditions as $field => $action) {
            if ($request->filled($field)) {
                $action($request->input($field));
            }
        }

        return $query;
    }
}
