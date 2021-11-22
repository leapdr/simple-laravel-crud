<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function uploadFiles(Request $request, $id){
        $files = $request->file("files");
        $uploaded = [];
        $imagePaths = [];
        if($files){
            $counter = 1;
            foreach($files as $file){
                $file->storeAs('images/products/' . $id, $counter . ".jpeg");
                $counter++;
                // $path = $file->getRealPath();
                // $imagePaths[] = $path;
                // if(is_file($path)){
                //     $uploaded[] = Storage::disk('local')->put("asdf/asdf.png", 
                //         file_get_contents($path));
                // }
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
