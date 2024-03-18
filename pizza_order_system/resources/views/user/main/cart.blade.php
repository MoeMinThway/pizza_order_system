@extends('user.layouts.master')
@section('content')



    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        {{-- {{$cartList}} --}}
                @foreach($cartList as $c)
                        <tr>
     {{-- <input type="hidden" name=""  id="pizzaPrice" value="{{$c->pizza_price}}"> --}}

                                <td  class="align-middle">
                                    <img src="{{asset('storage/'.$c->product_image)}}" class="shadow img-thumbnail" alt="" style="width: 100px;">
                                </td>
                            <td class="align-middle">

                                {{$c->pizza_name}}
                                <input type="hidden" class="productId" name="productId" id="productId" value="{{$c->product_id}}">
                                <input type="hidden" class="userId" name="userId" id="userId" value="{{$c->user_id}}">
                             </td>
                            <td class="align-middle"   id="pizzaPrice">{{$c->pizza_price}} kyats </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa text-white fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm  border-0 text-center" id="qty" value="{{$c->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa text-white fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total"> {{$c->qty * $c->pizza_price}} kyats </td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger btnRemove " id="btnRemove"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalPrice}} kyats </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium"> 3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotalPrice"> {{$totalPrice+3000}} kyats</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary text-white font-weight-bold my-3 py-3">
                            <span class="text-white">                            Proceed To Checkout
</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


@endsection

@section('scriptSource')

<script>
    $('#orderBtn').click(function(){
        // console.log("prder");
        // $userId = $('#userId').val();
        // console.log($userId);

        $random = Math.floor(Math.random()*10000001);
        // console.log($random);
          $orderList = [];
             $('#dataTable tbody tr').each(function(index,row){
                  $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace("kyats","")*1,
                    "order_code" : '0'+ $random
                  });
             })


            // console.log($orderList);
             $.ajax ({
                type: 'get',
                url :  'http://127.0.0.1:8000/user/ajax/order',
                data: Object.assign({},$orderList),
                dataType: 'json',
                success : function(respnse){
                        // console.log(respnse);
                        if(respnse.status == 'true'){
                                 window.location.href= "http://127.0.0.1:8000/user/homePage";

                        }
                }
            })

    })
</script>

<script>
    $(document).ready(function(){
              // When + click
        $(".btn-plus").click(function(){
            // console.log("pluse");
            $parentNode = $(this).parents("tr");
            // $price = $parentNode.find('#pizzaPrice').val();
            $price = Number($parentNode.find('#pizzaPrice').text().replace('kyats',""));

            $qty =Number (  $parentNode.find('#qty').val()) ;

            $total = $price*$qty;
             $parentNode.find('#total').html($total + " kyats " );

            calculationSumary();

        });
        // When - click
        $(".btn-minus").click(function(){
            $parentNode = $(this).parents("tr");
            // $price = $parentNode.find('#pizzaPrice').val();
                        $price = Number($parentNode.find('#pizzaPrice').text().replace('kyats',""));

             $qty =Number (  $parentNode.find('#qty').val());
         $('btn-minus').attr('disable');
            $total = $price*$qty;
             $parentNode.find('#total').html(`${$total} kyats` );

             calculationSumary();


        });
              // When remove click
        $('.btnRemove').click(function(){
            console.log("remove");
             $parentNode = $(this).parents("tr");
             $parentNode.remove();
            calculationSumary();

        })
        // common function
        function calculationSumary(){

             $summaryTotal = 0;
             $('#dataTable tbody tr').each(function(index,row){
                  $summaryTotal += Number ( $(row).find('#total').text().replace('kyats',""));
             })
            //  console.log($summaryTotal);
            $('#subTotalPrice').html(`${$summaryTotal} kyats`);
            $('#finalTotalPrice').html(`${$summaryTotal+3000} kyats`);
        }
    })
</script>

@endsection
{{--  --}}
