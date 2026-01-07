<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductImportTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_product_upsert_by_sku()
    {
        Product::create([
            'sku' => 'SKU1',
            'name' => 'Name',
            'price' => 100,
        ]);

        Product::updateOrCreate(
            ['sku' => 'SKU1'],
            ['name' => 'Updated Name', 'price' => 150]
        );

        $this->assertDatabaseHas('products', [
            'sku' => 'SKU1',
            'name' => 'Updated Name',
            'price' => 150,
        ]);
    }
}
