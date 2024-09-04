<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripIndexResource;
use App\Http\Resources\TripResource;
use App\Http\Resources\TripShowResource;
use App\Models\Tour;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $trips = new Trip();

        if ($request->has('capacity')) {
            $trips = $trips->where('capacity', '>=', $request->capacity);
        }

        if ($request->has('start_at')) {
            $trips = $trips->where('start_at', '<=', $request->start_at);
        }

        if ($request->has('end_at')) {
            $trips = $trips->where('end_at', '<=', $request->end_at);
        }

        if ($request->has('price_min')) {
            $trips = $trips->where(function ($query) use ($request) {
                $query->where('discount_price', '>=', $request->price_min)
                    ->orWhere(function ($query) use ($request) {
                        $query->whereNull('discount_price')
                            ->where('price', '>=', $request->price_min);
                    });
            });
        }

        if ($request->has('price_max')) {
            $trips = $trips->where(function ($query) use ($request) {
                $query->where('discount_price', '<=', $request->price_max)
                    ->orWhere(function ($query) use ($request) {
                        $query->whereNull('discount_price')
                            ->where('price', '<=', $request->price_max);
                    });
            });
        }

        if ($request->has('city_id')) {
            $trips = $trips->whereHas('tour', function ($query) use ($request) {
                $query->where('city_id', $request->city_id);
            });
        }

        if ($request->has('categories')) {
            $trips = $trips->whereHas('tour.categories', function ($query) use ($request) {
                $query->whereIn('category_id', $request->categories);
            });
        }

        if ($request->has('discount_only')) {
            $trips = $trips->whereNotNull('discount_price');
        }

        if ($request->has('popular')) {
            $trips = $trips->where('popular', true)->orWhere('recommended', true)
            ->orderByRaw(
                "popular DESC,
                recommended DESC",
                );
        }

        if ($request->has('sort')) {
            switch ($request->sort) {

                case 'safarjoo':
                    $trips = $trips->orderByRaw(
                    "recommended DESC,
                    CASE WHEN discount_price IS NOT NULL THEN 1 ELSE 0 END DESC,
                    created_at DESC"
                    );
                    break;

                case 'best_selling':
                    $trips = $trips->withCount('orders')
                    ->orderBy('orders_count', 'desc');
                    break;

                case 'expensive':
                    $trips = $trips->orderByRaw('COALESCE(discount_price, price) desc');
                    break;

                case 'cheap':
                    $trips = $trips->orderByRaw('COALESCE(discount_price, price) asc');
                    break;

                case 'nearest_date':
                    $trips = $trips->orderBy('start_at', 'asc');
                    break;

                default:
                    $trips = $trips->orderBy('id', 'desc');
            }
        } else {
            $trips = $trips->orderBy('id', 'desc');
        }

        $trips = $trips->paginate(10);
        return TripIndexResource::collection($trips);
    }

    public function store(Request $request)
    {
        $trip = Trip::create($request->toArray());
        return new TripShowResource($trip);
    }

    public function show(Request $request, string $id)
    {
        $trip = Trip::find($id);
        if (!$trip) {
            return $this->responseService->notFound_response('تور');
        }
        return TripShowResource::make($trip);
    }

    public function update(Request $request, string $id)
    {
        $trip = Trip::find($id);
        if (!$trip) {
            return $this->responseService->notFound_response();
        }
        $trip->discount_price = $request->discount_price;
        return $this->responseService->success_response($trip);
    }

    public function destroy(string $id)
    {
        $trip = Trip::find($id);
        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }
        $trip->delete();
        return response()->json(['message' => 'Trip deleted successfully']);
    }
}
