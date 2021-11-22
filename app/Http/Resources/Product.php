<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Model\Product as Prod;

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
        return parent::toArray($request);

        // return [
        //     'id'        => $this->id,
        //     'title'     => $this->title,
        //     'category'  => $this->category,
        // ];
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
