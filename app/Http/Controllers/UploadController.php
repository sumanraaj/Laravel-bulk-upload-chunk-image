<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $uploadId = $request->upload_id;
        $chunk = $request->file('chunk');
        $path = storage_path("app/chunks/{$uploadId}");

        if (!file_exists($path)){
            mkdir($path, 0777, true);
        }

        $chunk->move($path, $request->chunk_index);

        return response()->json(['status' => 'chunk_received']);
    }

    public function complete(Request $request)
    {
        $upload = Upload::firstOrCreate([
            'upload_id' => $request->upload_id,
            'checksum' => $request->checksum,
        ]);

        $chunkPath = storage_path("app/chunks/{$upload->upload_id}");
        $finalPath = storage_path("app/uploads/{$upload->upload_id}.jpg");

        $out = fopen($finalPath, 'ab');

        foreach (scandir($chunkPath) as $file){
            if (is_numeric($file)) {
                fwrite($out, file_get_contents("$chunkPath/$file"));
            }
        }

        fclose($out);

        if (hash_file('sha256', $finalPath) !== $upload->checksum){
            unlink($finalPath);
            abort(422, 'Checksum mismatch');
        }

        $upload->update(['completed'=> true]);
        return response()->json(['status'=>'completed']);
    }
}


