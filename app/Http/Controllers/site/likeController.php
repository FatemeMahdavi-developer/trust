<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\product;
use App\Models\like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($module,$module_id=null)
    {
        $model=self::model($module);
        if(!is_null($module_id))
            $liketable=$model::find($module_id);
        $liketable=$model::find(request()->get('module_id'));

        if($liketable->count() > 0){
            if($liketable->like()->where('user_id',auth()->id())->count()){

                return json_encode(['error'=>'نظر شما قبلا ثبت شده است']);
                
            }else{
                if(request()->has('kind'))
                    $kind=request()->get('kind');

                $liketable->like()->create([
                    'user_id'=>auth()->id(),
                    'kind'=>$kind ?? 'like'
                ]);
                if($module=='comment'){
                    if($kind=='dislike'){
                        $liketable->update(['count_dislike'=>$liketable->count_dislike+1]);
                    }elseif($kind=='like'){
                        $liketable->update(['count_like'=>$liketable->count_like+1]);
                    }
                }
                if($kind=='dislike')
                    return json_encode(['sucess'=>'نپسندیدم','icone_alert'=>'error']);
                return json_encode(['sucess'=>'پسندیده شد','icone_alert'=>'success']);
            }
        }else{
            return json_encode(['error'=>'نتیجه ای یافت نشد']);
        }
    }

    public function model($module)
    {
        $models = [
            'product' => product::class,
            'comment' => comment::class,
        ];
        return $models[$module];
    }
}
