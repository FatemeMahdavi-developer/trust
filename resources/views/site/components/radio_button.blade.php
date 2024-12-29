@props(['name'=>'','title'=>'','value'=>'','loop_lang'=>[]])

<div class="col-md-12 col-sm-12">
    <div class="input-box">
        <label class="label_title">{{$title}}</label>    
        <div class="rdl">
            @foreach ($loop_lang as $key=>$val)   
            <label>
                <input type="radio" name="{{$name}}" value="{{$key}}" @if($key==$value) checked @endif>
                    <span></span>{{$val}}                            
            </label>
            @endforeach
        </div>
        @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
    </div>
</div>