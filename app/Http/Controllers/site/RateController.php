<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\news;
use App\Models\product;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function store(Request $request,$module,$item_id)
    {
        $model = self::model($module);
        $rateable = $model::find($item_id);
        if($rateable->count() > 0){
            if($rateable->rate()->where('user_id',auth()->id())->count()){
                return json_encode(['error'=>__('common.rate.error')]);
            }else{
                $rateable->rate()->create([
                    'user_id'=>auth()->id(),
                    'rate_number' =>$request->rate,
                    'rate_kind' =>$request->rate_kind,
                ]);
                return json_encode(['sucess'=>__('common.rate.success')]);
            }
        }else{
            return json_encode(['error'=>__('common.messages.result_not_found')]);
        }
    }

    public function model($module)
    {
        $models = [
            'news' => news::class,
            'product' => product::class
        ];
        return $models[$module];
    }
}
