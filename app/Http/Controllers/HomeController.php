<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'featured_destinations' => Destination::orderBy('rating', 'desc')
                    ->take(6)
                    ->get(),
                'featured_hotels' => Hotel::with('destination')
                    ->where('rating', '>=', 4)
                    ->orderBy('rating', 'desc')
                    ->take(6)
                    ->get(),
                'latest_posts' => BlogPost::latest()
                    ->take(3)
                    ->get()
            ];

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi tải dữ liệu'
            ], 500);
        }
    }
}
