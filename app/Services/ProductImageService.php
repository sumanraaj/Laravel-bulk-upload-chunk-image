<?php

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductImageService
{
    public function attach(Request $request, Product $product)
    {
        DB::transaction(function () use ($product, $request) {

            Image::where('product_id', $product->id)
                ->update(['primary' => false]);

            Image::firstOrCreate([
                'product_id' => $product->id,
                'path' => $request->path,
            ], [
                'primary' => true
            ]);
        });

        return response()->json(['status' => 'attached']);
    }
}