@props(['title'=>'','name'=>'','title_button'=>'','value'=>'','class'=>''])
<div class="col-md-6 col-sm-12">
    <div class="input-box {{$class}}">
        @if($title)<label for="{{$name}}">{{$title}}</label>@endif
        <input type="file" id="{{$name}}" name="{{$name}}" class="form-control">
        @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
    </div>
</div>

<script>
$("input[name='{{$name}}']").on("change",function(){
    Swal.fire({
        icon: "success",
        title: "فایل شما با موفقیت آپلود شد",
        showConfirmButton: false,
        timer: 1500
    });
});
</script>