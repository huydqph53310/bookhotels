<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        try {
            Log::info('Hotel index request', ['request' => $request->all()]);

            $query = Hotel::query();

            // Tìm kiếm
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
                });
            }

            // Lọc theo giá
            if ($request->filled('price_min') && $request->filled('price_max')) {
                $query->whereBetween('price', [
                    (float) $request->price_min,
                    (float) $request->price_max
                ]);
            }

            // Lọc theo rating
            if ($request->filled('rating')) {
                $query->where('rating', '>=', (int) $request->rating);
            }

            // Sắp xếp
            $sortBy = $request->input('sort_by', 'created_at');
            $sortOrder = $request->input('sort_order', 'desc');

            // Chỉ cho phép các trường hợp lệ
            $allowedSortFields = ['created_at', 'price', 'rating', 'name'];
            $sortBy = in_array($sortBy, $allowedSortFields) ? $sortBy : 'created_at';
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'desc';

            $query->orderBy($sortBy, $sortOrder);

            $hotels = $query->paginate(9)->withQueryString();

            Log::info('Hotel query result', ['count' => $hotels->count()]);

            return response()->json([
                'status' => 'success',
                'data' => $hotels
            ]);

        } catch (\Exception $e) {
            Log::error('Hotel index error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi tải danh sách khách sạn: ' . $e->getMessage()
            ], 500);
        }
    }
}
