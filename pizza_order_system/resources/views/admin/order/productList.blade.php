@extends('admin.layouts.master')

@section('title','Product | List')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->



<a href="{{route('admin#orderList')}}" class="text-dark">
    <i class="fa-solid fa-arrow-left-long mx-2"></i>Back
</a>

<div class="row ">

<div class="col-6 p-3">
    <div class="card mt-3">
        <div class="card-body mt-3 p-2" >
            <h3><i class="fa-solid fa-clipboard mx-4"></i> Order Info</h3>
            <small class="text-warning mx-4">
                <i class="fa-solid fa-circle-exclamation"></i>
                Include Delivery Charges</small>
        </div>

    <div class="cart-body p-3">
        <div class="row mb-3">
            <div class="col"> <i class="fa-solid mx-3 fa-user"></i> Name </div>
            <div class="col"> {{ strtoupper($orderList[0]->user_name)}}  </div>
        </div>
        <div class="row mb-3">
            <div class="col"> <i class="fa-solid mx-3 fa-barcode"></i>Order Code </div>
            <div class="col"> {{ strtoupper($orderList[0]->order_code)}}    </div>
        </div>
        <div class="row mb-3">
            <div class="col"> <i class="fa-solid mx-3 fa-calendar-days"></i>Order Date  </div>
            <div class="col"> {{ strtoupper($orderList[0]->created_at->format('F-j-Y'))}}    </div>
        </div>
        <div class="row mb-3">
            <div class="col"><i class="fa-solid mx-3 fa-signal"></i>Status   </div>
            <div class="col">
                @if ($orderStatus[0]->status == 0)
                                    <span class="text-warning  "><i class="fa-regular fa-clock me-2"></i> Pending</span>


                @elseif($orderStatus[0]->status == 1)
                                    <span class="text-success  "><i class="fa-solid fa-check me-2"></i> Success</span>
                @elseif($orderStatus[0]->status == 2)
                                    <span class="text-danger  "><i class="fa-solid fa-triangle-exclamation"></i> Reject</span>

                @endif

                {{-- {{$orderStatus[0]->status}} --}}
             </div>
        </div>
                <div class="row mb-3">
            <div class="col"> <i class="fa-solid mx-3 fa-money-bill-wave"></i>Total Price  </div>
            <div class="col"> {{ $orderStatus[0]->total_price}}  kyats </div>
        </div>

    </div>
</div>
</div>

</div>


          <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>Order Id</th>
                         <th>Product Image</th>
                        <th>Product Name</th>


                        {{-- <th>Order Date</th> --}}
                        <th>Product Price</th>
                        <th>Oty</th>
                        <th>Amount</th>



                    </tr>
                </thead>

                <tbody id="dataList">

                    @foreach ($orderList as $o)

                    <tr class="tr-shadow">
                            {{-- <td> </td> --}}
                        <td ></td>
                        <td >{{$o->id}}</td>
                        <td >
                            {{-- {{$o->product_image}} --}}
                            <img src="{{asset('storage/'.$o->product_image)}}" width="100px"     class="img-thumbnail" alt="No Image">
                        </td>
                                                <td >{{$o->product_name}}</td>

                        {{-- <td >{{$o->created_at->format('F-j-Y')}}</td> --}}

                        <td class="">{{$o->product_price}}</td>
                        <td class="">{{$o->qty}}</td>
                                                <td class="amount">{{$o->total}}</td>


                    </tr>
                    @endforeach



                </tbody>

            </table>
            <div class="mt-3">
                {{-- {{$orders->links()}} --}}
            </div>

        </div>




                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
@section('scriptSection')


@endsection
{{--  --}}
