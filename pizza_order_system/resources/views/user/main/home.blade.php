

 @extends('user.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control bg-dark text-white py-1 px-3  d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="mt-2" for="price-all">Category</label>
                        <span class="badge border font-weight-normal">{{count($category)}} </span>
                    </div>

                     <div class="custom-control  d-flex align-items-center justify-content-between mb-3  pt-1">
                        <a href="{{route('user#home')}}" class="text-dark">
                                <label class="" for="price-1"> All</label>
                            </a>
                    </div>

                    @foreach ($category as $c)
                    <div class="custom-control  d-flex align-items-center justify-content-between mb-3  pt-1">
                        <a href="{{route('user#filter',$c->id)}}" class="text-dark">
                                <label class="" for="price-1"> {{$c->name}} </label>
                            </a>
                    </div>
                    @endforeach


                </form>
            </div>
            <!-- Price End -->


            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->

        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>

<a href="{{route('user#cartList')}}">

                            <button type="button" class="btn bg-dark text-white position-relative">
    <i class="fa-solid fa-cart-shopping "></i>
       <span class="position-absolute  start-100 translate-middle badge rounded-pill bg-danger" style="top: -5px">
      
        {{count($cart)}}

  </span>
</button>
</a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest (Descending)</a>
                                    <a class="dropdown-item" href="#">Old    (Ascending)</a>
                                </div> --}}
                               <select name="sorting" id="sortingOption" class="form-control">
                                <option value="">Choose Option</option>
                                <option value="asc">Ascending </option>
                                <option value="desc">Descending </option>
                               </select>
                            </div>

                        </div>
                    </div>
                </div>
                                {{-- <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " > --}}

                <span class="row" id="dataList">
                    @if(count($pizzas )!=0)
                       @foreach ($pizzas as $pizza)
                <div class="col-lg-4 col-md-6 col-sm-6  pb-1 "  style="width: 500px">
                    <div class="product-item bg-light mb-4" id="myForm" >
                        <div class="product-img position-relative overflow-hidden">
                            {{-- @if($pizza->image != null ||$pizza->image !="" ) --}}
                                                        <img class="img-fluid w-100" style="height: 210px;width: 1000px;" src="{{asset('storage/'.$pizza->image)}}" alt="Default">

                            {{-- @endif --}}
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$pizza->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$pizza->name}} </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5> {{$pizza->price}}  kyats </h5>
                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                            </div>
                            {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @endforeach


                    @else
                        <div class="col-6 offset-3 fs-1 " style="width: 1000px">
   <p class="text-center shadow  h1 text-danger py-5" >There is no pizza <i class="fa-solid fa-pizza-slice mx-3"></i> </p>

                        </div>
                    @endif




                </span>




            </div>
        </div>

        <!-- Shop Product End -->
    </div>
</div>
@endsection


@section('scriptSource')

    <script>
        // $(document).ready(function(){
        //     alert("HEllo")
        // });
        $(document).ready(function(){
            // $.ajax ({
            //     type: 'get',
            //     url :  'http://127.0.0.1:8000/user/ajax/pizza/list',
            //     dataType: 'json',
            //     success : function(respnse){
            //             console.log(respnse);
            //     }
            // })

            $('#sortingOption').change(function(){
                  $eventOption = $('#sortingOption').val();
                // console.log($eventOption);
                if($eventOption =='desc'){
                      $.ajax ({
                type: 'get',
                url :  'http://127.0.0.1:8000/user/ajax/pizza/list',
                data : { 'status' : 'desc'},
                dataType: 'json',
                success : function(respnse){
                        // console.log(respnse);
                        // console.log(respnse[0].name);
                        $list = '';
                        for( $i = 0 ; $i<respnse.length;$i++){
                             $list +=`
                                             <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " style="height: 400px">

                               <div class="product-item bg-light mb-4" id="myForm" >
                             <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 210px;" src="{{asset('storage/${respnse[$i].image} ')}}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${respnse[$i].name} </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5> ${respnse[$i].price}  kyats </h5>
                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                        </div>
                        </div>
                        `;
                        }
                        console.log($list);

                        $('#dataList').html($list);






                }
            })


                }else if($eventOption =='asc'){


                    $.ajax ({
                type: 'get',
                url :  'http://127.0.0.1:8000/user/ajax/pizza/list',
                data : { 'status' : 'asc'},
                dataType: 'json',
                success : function(respnse){
                        console.log(respnse);

                           $list = '';
                        for( $i = 0 ; $i<respnse.length;$i++){
                             $list +=`
                                             <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " style="height: 400px">

                               <div class="product-item bg-light mb-4" id="myForm" >
                             <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 210px;" src="{{asset('storage/${respnse[$i].image} ')}}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${respnse[$i].name} </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5> ${respnse[$i].price}  kyats </h5>
                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                        </div>
                        </div>
                        `;
                        }
                        console.log($list);

                        $('#dataList').html($list);



                }
            })
                }
            })

        });
    </script>

@endsection
{{--  --}}
