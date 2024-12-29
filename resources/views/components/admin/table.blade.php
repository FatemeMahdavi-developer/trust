@props(['column'=>[],'item'=>[]])
<table class="table table-bordered table-striped table-md">
    <tbody>
    <tr>
       @foreach($column as $key => $value)
            <th style="border-color: #ddd;">{{$value}}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($column as $key => $value)
            @if(isset($item->$key))
                <td style="border-color: #ddd;">{!! $item->$key !!}</td>
            @endif
        @endforeach
    </tr>
    </tbody>
</table>
