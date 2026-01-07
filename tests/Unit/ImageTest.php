<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ImageService;

class ImageTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_generates_image_variants()
    {
        $path = storage_path('app/task.jpg');

        copy(base_path('tests/Fixtures/task.jpg'), $path);

        ImageService::generateVariants($path);

        $this->assertFileExists(str_replace('.jpg', '_256.jpg', $path));
    }
}


