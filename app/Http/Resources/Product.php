<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Model\Product as Prod;
use Illuminate\Support\Facades\Storage;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        # check any uploaded images
        $prodImages = Storage::files('public/images/products/' . $this->id);
        $imgCount = count($prodImages);
        $imgMain = asset('/storage/images/products/' . $this->id . "/1.jpeg");

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'category'      => $this->category,
            'description'   => $this->description,
            'datetime'      => $this->datetime,
            'imgCount'      => $imgCount,
            'mainImage'     => $imgMain,
        ];
    }

    public function with($request){
        $categories = DB::table('products')->distinct('category')->get();

        if( $categories ){
            $distinctCategories = $categories->unique('category')->pluck('category')->toArray();
            return [
                "category" => $distinctCategories,
            ];
        }
    }
}
