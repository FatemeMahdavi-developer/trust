@extends("admin.layout.base")
@php $module_name= $module_title . " ویرایش "@endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header d-flex justify-content-between">
                                <h4> جزییات سفارش شماره {{$order->ref_number}}</h4>
                                <div class="d-flex">
                                    <a href="">
                                      <div class="icon-preview" >
                                        <i class="fas fa-print"></i>
                                      </div>
                                    </a>
                                  <div class="badge badge-info" style="width:70px">
                                      {{$status[$order->state->value]}}
                                  </div>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="p-3"></div>
                                        <div class="p-3"><strong>آقا / خانم:</strong></div>
                                        <div class="p-3"><strong>ایمیل:</strong></div>
                                        <div class="p-3"><strong>نوع پرداخت:</strong></div>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <div class="p-3">{{$order->date_convert()}}</div>
                                        <div class="p-3">{{$order->user->name.' '.$order->user->lastname}}</div>
                                        <div class="p-3">{{$order->user->username}}</div>
                                        <div class="p-3">{{$kind_payment[$order->state->value]}}</div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h4>مشخصات کمد</h4>
                              </div>
                              <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>کمد</th>
                                                <th>کد</th>
                                                <th>سایز</th>
                                                <th>ابعاد</th>
                                                <th>قیمت</th>
                                                <th> زمان رزرو</th>
                                                <th>قیمت نهایی</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                  {{$order->basket->box->title}}
                                                </td>
                                                <td>
                                                  {{$order->basket->box->number_box}}
                                                </td>
                                                <td>
                                                  <div class="text-time">{{$order->size->value}}</div>
                                                </td>
                                                <td>
                                                    <div class="text-time">{{$order->price}} تومان</div>
                                                </td>
                                                <td>
                                                    <div class="text-time">1 ساعت</div>
                                                </td>
                                                <td>
                                                    <div class="text-time">{{$order->price * 1}} تومان</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-12 col-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                              <div class="card-header">
                                <h4>زمان تحویل کمد</h4>
                              </div>
                              <div class="card-body">
                                  @if($order->basket->expired_at)
                                    <div class="alert alert-success showDate text-center">{{$order->basket->date_convert('expired_at','H:i:s Y/m/d')}}</div>
                                  @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h4>جزییات پرداخت</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="alert text-center d-flex justify-content-between"> <span>نام واریز کننده :</span> {{$order->payment->name}}</div> --}}
                                    {{-- <div class="alert text-center d-flex justify-content-between"> <span>شماره فیش :</span> {{$order->payment->fish_number}}</div> --}}
                                    @component($prefix_component.".form",['action'=>route('admin.order.update',['order'=>$order['id']]),'method'=>'post'])
                                        @slot("content")
                                            @method("put")
                                            @component($prefix_component."select",['name'=>'state','title'=>'وضعیت','class'=>'w-100','items'=>$state_payment,'value_old'=>$order->payment->state->value])@endcomponent
                                            @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                        @endslot
                                    @endcomponent
                                </div>
                            </div>
                        </div>

                    </div>
                  </div>
              </div>
        </div>
    </section>
@endsection
