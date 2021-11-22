<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function uploadFiles(Request $request, $id){
        $prodDir = "public/images/products/" . $id;
        $files = $request->file("files");
        $uploaded = [];
        $imagePaths = [];
        if($files){
            $counter = 1;

            # empty directory first
            Storage::deleteDirectory($prodDir);

            # save uploads
            foreach($files as $file){
                $file->storeAs($prodDir, $counter . ".jpeg");
                $counter++;
            }
        }
        

        return response([
            'paths'         => $imagePaths,
            'uploaded'      => $uploaded,
            'message'       => $request->all(),
            'queryparam'    => $request->query('asd') 
        ], 202);
    }
}
