<?php

namespace App\Http\Controllers\site\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\commentRequest;
use App\Models\comment;
use App\Models\news;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{
    public function store(Request $request,string $type,int $module_id){
        $validation=Validator::make($request->all(),[
            'note'=>'required|string',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $note=nl2br(e($request->note));
        $model = self::model($type);
        $commentable=$model::findOrFail($module_id);
        $commentable->comment()->create([
            'note'=>$note,
            'ip_address'=>request()->ip(),
            'user_id'=>auth()->id(),
        ]);
        return response()->json([
            'success'=>'comment created successfully'
        ],202);
    }

    private function model($model)
    {
        $models= [
            'news' => news::class,
            'product' => product::class
        ];
        return $models[$model];
    }

}
