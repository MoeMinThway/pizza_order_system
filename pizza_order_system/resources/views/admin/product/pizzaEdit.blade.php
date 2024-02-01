@extends('admin.layouts.master')

@section('title','Product | Details')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="row">
        <div class="col-3 offset-7  ">
            @if (session('updateSuccess'))

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i>     {{session('updateSuccess')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">

                                {{-- <a href="{{route('product#list')}}"> --}}
                                    <i class="fa-solid fa-arrow-left me-2 text-dark" onclick="history.back()" style="cursor: pointer"></i>
                                {{-- </a> --}}

                        </div>

                        <div class="card-title">
                            {{-- <h3 class="text-center title-2"> Pizza Details  </h3> --}}
                        </div>

                        <div class="row">
                            <div class="col-3 offset-1">

                                <img src="{{asset('storage/'.$pizza->image)}}" alt="John Doe"
                                class="img-thumbnail shadow-sm" />


                            </div>
                            <div class="col-8 ">

                                    <div class="my-3  btn bg-danger text-white d-block w-50 fs-5 text-center  "><i class="fa-solid fs-5 fa-pizza-slice me-1"></i>  {{$pizza->name}}</div>
                                    <span class="my-3 btn btn-dark text-white"> <i class="fa-solid fs-5 fa-dollar-sign me-1"></i>  {{$pizza->price}} kyats  </span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fs-5 fa-stopwatch me-1"></i>  {{$pizza->waiting_time}} <span class="mx-1">mins</span></span>
                                    <span class="my-3 btn btn-dark text-white    "> <i class="fa-solid fs-5 fa-eye me-1"></i>  {{$pizza->view_count}}</span>
                                    <span class="my-3 btn btn-dark text-white    "> <i class="fa-solid fs-5 fa-coins me-1"></i>  {{$pizza->category_id}}</span>
                                    <span class="my-3  btn btn-dark text-white"> <i class="fa-solid  fs-5 fa-user-clock  me-1"></i> {{$pizza->created_at->format("j-F-Y")}}</span>


                                    <div class="my-3  "> <i class="fa-solid fa-file-lines me-2"></i>Details
                                </div>
                                <div class="">        {{$pizza->description}}</div>





                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
{{--  --}}
