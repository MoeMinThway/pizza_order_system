@extends('admin.layouts.master')

@section('title','Account | Details')
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
                            {{-- <a href="{{route('category#list')}}"> --}}
                                <i class="fa-solid fa-arrow-left me-2" onclick="hisory.back()" style="cursor: pointer"></i>
                             {{-- </a> --}}
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info  </h3>
                        </div>

                        <div class="row">
                            <div class="col-3 offset-2">
                                @if (Auth::user()->image==null)
                                <img src="{{asset('image/default-user.jpeg')}}" alt="John Doe"
                                class="img-thumbnail shadow-sm" />

                                @else
                                <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail shadow-sm" alt=" " />

                                @endif
                            </div>
                            <div class="col-5 offset-1">

                                        <h4 class="my-3"> <i class="fa-solid fa-user-pen me-2"></i>  {{Auth::user()->name}}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-envelope me-2"></i>  {{Auth::user()->email}}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-phone me-2"></i>   {{Auth::user()->phone}}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-address-card me-2"></i>  {{Auth::user()->address}}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-venus-mars me-2"></i>  {{Auth::user()->gender}}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-user-clock  me-2"></i> {{Auth::user()->created_at->format("j - F - Y")}}</h4>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 offset-2 mt-3">
                              <a href="{{route('admin#edit')}}">
                                <button class="btn btn-dark text-white ">
                                    <i class="fa-solid fa-pen-to-square me-2"></i>  Edit Profile
                                </button>
                              </a>
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
