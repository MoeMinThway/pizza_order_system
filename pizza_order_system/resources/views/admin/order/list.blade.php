@extends('admin.layouts.master')

@section('title','Product | List')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>

                        </div>
                    </div>

                </div>




             <div class="row">
                <div class="col-3">
                    <h4 class="text-secondary">Search key : <span class="text-danger">{{request('key')}}</span> </h4>
                </div>
                <div class="col-3 offset-6">
                    <form action="{{route('admin#orderList')}}" method="GET">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="key" class="form-control" placeholder="Search" value="{{request('key')}}">
                        <button type="submit" class="btn btn-dark">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        </div>
                    </form>
                </div>
             </div>

             <div class="row mt-2">
                <div class="col-1 offset-10 bg-white shadow-sm p-2   text-center">
                    <h3><i class="fa-solid fa-database mr-2"></i> {{$orders->total( )}}

                    </h3>
                </div>
             </div>

             <div class="d-flex">
                                    <label class="mx-4 mt-2" for="">Order Status</label>

                 <select name="status" id="orderStatus" class="form-control col-2">
                                        <option   value="">All</option>
                                        <option   value="0">Pending</option>
                                        <option  value="1">Accept</option>
                                        <option  value="2">Reject</option>
                                    </select>
             </div>

          <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>

                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Order Date</th>
                        <th>Order Code</th>
                        <th>Amount</th>
                        <th>Status</th>



                    </tr>
                </thead>

                <tbody id="dataList">

                    @foreach ($orders as $o)

                    <tr class="tr-shadow">
                        <input type="hidden" value="{{$o->id}}" class="orderId">
                        <td >{{$o->user_id}}</td>
                        <td >{{$o->user_name}}</td>
                        <td >{{$o->created_at->format('F-j-Y')}}</td>
                        <td >{{$o->order_code}}</td>
                        <td class="amount">{{$o->total_price}}</td>
                        <td >
                                    <select name="status" class="form-control statusChange">
                                        <option  @if ($o->status == 0) selected @endif value="0">Pending</option>
                                        <option @if ($o->status == 1) selected @endif value="1">Accept</option>
                                        <option @if ($o->status == 2) selected @endif value="2">Reject</option>
                                    </select>
                        </td>
                    </tr>
                    @endforeach


                </tbody>

            </table>
            <div class="mt-3">
                {{$orders->links()}}
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


<script>
    $(document).ready(function(){
        $('#orderStatus').change(function(){
            $status = $('#orderStatus').val();
            // console.log($status);
            // $orderStatus="";


            // switch($status){
            //     case '0': $orderStatus=0; break;
            //     case '1': $orderStatus=1; break;
            //     case '2': $orderStatus=2; break;
            //     default: $orderStatus=""; break;
            // }
            console.log($status);

            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/order/ajax/status",
                data : {"status": $status},
                dataType: 'json',
                success : function (response){
                        // console.log(response);



                                        $list = '';
                        for( $i = 0 ; $i<response.length;$i++){

                            // date
                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                             $dbDate = new Date(response[$i].created_at);
                            $finalDate =  $months[$dbDate.getMonth()]+ " - "+$dbDate.getDate()+ " - "+ $dbDate.getFullYear();
                            // console.log($finalDate);


                                // status
$statusMessage="";
                                if(response[$i].status == 0){
                                        $statusMessage=
                                        `
                                                <select name="status" class="form-control statusChange">
                                        <option selected value="0">Pending</option>
                                        <option  value="1">Accept</option>
                                        <option value="2">Reject</option>

                                    </select>
                                        `;
                                }
                               else if(response[$i].status == 1){
                                        $statusMessage=
                                        `
                                                <select name="status" class="form-control statusChange">
                                        <option value="0">Pending</option>
                                        <option selected  value="1">Accept</option>
                                        <option value="2">Reject</option>

                                    </select>
                                        `;
                                }
                                else if(response[$i].status == 2){
                                        $statusMessage=
                                        `
                                                <select name="status" class="form-control statusChange">
                                        <option value="0">Pending</option>
                                        <option  value="1">Accept</option>
                                        <option selected value="2">Reject</option>

                                    </select>
                                        `;
                                }
                             $list +=`
                                               <tr class="tr-shadow">
                   <input type="hidden" value="${response[$i].id}" class="orderId">

                        <td >${response[$i].user_id}</td>
                        <td >${response[$i].user_name}</td>
                        <td >${$finalDate}</td>
                        <td >${response[$i].order_code}</td>
                        <td class="amount" >${response[$i].total_price}</td>

                        <td >
                            ${$statusMessage}
                        </td>
                    </tr>
                        `;
                        }
                        // console.log($list);

                        $('#dataList').html($list);

                }
            });
        })

        // status change
        $('.statusChange').change(function (){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');

            $orderId =$parentNode.find('.orderId').val();

            console.log($parentNode.find('.amount').html());


            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/order/ajax/change/status",
                data : {
                    "status": $currentStatus,
                    "orderId": $orderId,
            },
                dataType: 'json',
                success : function (response){
                }

            })
            // window.location.href ="http://127.0.0.1:8000/order/list";


        })
    });
</script>
@endsection
{{--  --}}
