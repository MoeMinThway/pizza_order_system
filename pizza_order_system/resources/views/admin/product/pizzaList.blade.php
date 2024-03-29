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
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                       
                    </div>
                </div>


            @if (session('deleteSuccess'))
            <div class="col-4 offset-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i>     {{session('deleteSuccess')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
             </div>
            @endif

             <div class="row">
                <div class="col-3">
                    <h4 class="text-secondary">Search key : <span class="text-danger">{{request('key')}}</span> </h4>
                </div>
                <div class="col-3 offset-6">
                    <form action="{{route('product#list')}}" method="GET">
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
                    <h3><i class="fa-solid fa-database mr-2"></i> {{$pizzas->total()}}

                    </h3>
                </div>
             </div>

          @if (count($pizzas) != 0)
          <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>

                        <th>Image</th>
                        <th>Pizza Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>View Count</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pizzas as $p)
                    <tr class="tr-shadow">

                        <td class="col-2">
                            <img src="{{asset('storage/'.$p->image)}}" class="img-thumbnail shadow-sm" alt="">
                        </td>
                        <td class="3" >{{$p->name}}</td>

                        <td class="2" >{{$p->category_id}}</td>
                        <td class="2" >{{$p->price}} $</td>
                        <td class="2" > <i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                        {{-- <td>{{$product->created_at->format('j-F-Y')}}</td> --}}
                        <td>
                            <div class="table-data-feature">
                                <a href="{{route('product#edit',$p->id)}}" class="mr-3">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-solid fa-eye"></i>

                                    </button>
                                </a>
                                <a href="{{route('product#updatePage',$p->id)}}" class="mr-3">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </button>
                                </a>
                         <a href="{{route('product#delete',$p->id)}}">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                         </a>

                            </div>
                        </td>
                    </tr>

                    @endforeach



                </tbody>

            </table>
            <div class="">
                {{$pizzas->links()}}
                {{-- {{$pizzas->appends(request()->query())->links()}} --}}
            </div>

        </div>

        @else
<div class="m-5">
    <h3 class="text-center text-secondary">There is no <span class="fs-10 text-danger">Pizza</span> data here</h3>

</div>

          @endif

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
{{--  --}}
