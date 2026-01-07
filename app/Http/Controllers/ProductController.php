<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function import(Request $request)
    {
        $file = fopen($request->file('csv'), 'r');

        $header = fgetcsv($file);
        $required = ['sku', 'name', 'price'];

        $summary = ['total' => 0, 'imported' => 0, 'updated' => 0, 'invalid' => 0, 'duplicates' => 0];

        $seenSkus = [];

        while ($row = fgetcsv($file)) {
            $summary['total']++;
            $data = array_combine($header, $row);
            if (array_diff($required, array_keys($data))){
                $summary['invalid']++;
                continue;
            }

            if (in_array($data['sku'], $seenSkus)){
                $summary['duplicates']++;
                continue;
            }

            $seenSkus[] = $data['sku'];
            $product = Product::where('sku', $data['sku'])->first();
            Product::updateOrCreate(
                ['sku' => $data['sku']],
                ['name' => $data['name'], 'price' => $data['price']]
            );

            $product ? $summary['updated']++ : $summary['imported']++;
        }

        fclose($file);
        return response()->json($summary);
    }
}


