@extends('admin.layouts.master')

@section('title','Category | Change Password')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">back</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password </h3>
                        </div>
                        @if (session('notMatch'))
                        <div class="col-12 ">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>     {{session('notMatch')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                         </div>
                        @endif
                        @if (session('pwChangeSuccess'))
                        <div class="col-12 ">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i>   {{session('pwChangeSuccess')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                         </div>
                        @endif
                        <form action="{{route('admin#changPassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="oldPassword" class="control-label mb-1">Old Pasword</label>
                                <input id="oldPassword " name="oldPassword" type="password"
                                 class="form-control
                                 @if('notMatch')  is-invalid  @endif
                                  @error('oldPassword')   is-invalid   @enderror"
                                aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                            @error('oldPassword')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                            @if (session('notMatch'))
                            <div class="invalid-feedback text-danger">
                                {{session('notMatch')}}
                            </div>

                            @endif

                        </div>
                            <div class="form-group">
                                    <label for="newPassword" class="control-label mb-1">New Pasword</label>
                                    <input id="newPassword " name="newPassword" type="password"
                                     class="form-control
                                    @error('newPassword')   is-invalid   @enderror"
                                   aria-required="true" aria-invalid="false" placeholder="Enter new Password">
                                  @error('newPassword')
                                         <div class="invalid-feedback text-danger">{{$message}}</div>
                                 @enderror
                              </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="control-label mb-1">Confirm Pasword</label>
                                <input id="confirmPassword " name="confirmPassword" type="password"
                                 class="form-control     @error('confirmPassword')   is-invalid   @enderror"

                                aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                            @error('confirmPassword')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key mx-2"></i>
                                    <span id="payment-button-amount">Change Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
{{--  --}}
