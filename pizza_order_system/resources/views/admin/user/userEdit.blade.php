@extends('admin.layouts.master')

@section('title','Category | List')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">User Profile  </h3>
                        </div>

                        <form action="{{route('admin#userUpdate',$user->id)}}" enctype="multipart/form-data" method="post">
@csrf
                            <div class="row">
                                <div class="col-4 offset-1 ">
                                    @if ($user->image==null)
                                                                @if($user->gender=="male")
                                                                <img src="{{asset('image/default-user.jpeg')}}" class="img-thumbnail" alt="John Doe" />

                                                                @else
                                                                <img src="{{asset('image/default-user-girl.jpeg')}}" class="img-thumbnail" alt="John Doe" />

                                                                @endif
                                                 @else
                                                            <img src="{{asset('storage/'.$user->image)}}" alt=" " />
                                                    @endif


                        <div class="mt-3">
                                <input type="file" name="image" class="form-control col-12
                                @error('image')   is-invalid   @enderror">
                                @error('image')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mt-3 ">
                            <div class="form-group  col-12">
                                <label for="role" class="control-label my-1">Role</label>
                                <input id="role " name="role" type="text"
                                class="form-control col-12
                                @error('role')   is-invalid   @enderror"
                                value="{{old('role',$user->role)}}"
                            aria-required="true" aria-invalid="false"  disabled>

                            </div>
                        </div>
                        <div class="mt-3">
                                <button type="submit" class="btn btn-dark text-white col-12" >
                                   Update    <i class="fa-solid fa-circle-arrow-up mx-2"></i>
                                </button>
                        </div>

                        <div class="mt-5">

                                <a href="{{route('admin#userList')}}"><button class="btn bg-warning text-white my-3"><i class="fa-solid fa-circle-chevron-left me-2"></i> Cannel</button></a>

                        </div>
                                </div>

                                <div class="row col-6 ">
                                    <div class="form-group col-10">
                                        <label for="name" class="control-label mb-1 ">Name</label>
                                        <input id="name " name="name" type="text"
                                        class="form-control @error('name')   is-invalid   @enderror"
                                        value="{{old('name',$user->name)}}"
                                     placeholder="Enter Admin Name">
                                    @error('name')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                </div>


                                <div class="form-group col-10">
                                    <label for="email" class="control-label mb-1">Email</label>
                                    <input id="email " name="email" type="email"
                                    class="form-control @error('email')   is-invalid   @enderror"
                                    value="{{old('email',$user->email)}}"
                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                @error('email')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                            </div>

                            <div class="form-group col-10">
                                <label for="phone" class="control-label mb-1">Phone</label>
                                <input id="phone " name="phone" type="number"
                                class="form-control  @error('phone')   is-invalid   @enderror"
                                value="{{old('phone',$user->phone)}}"
                            aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone ">
                            @error('phone')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                        @enderror
                                    </div>

                                    <div class="form-group col-10  ">
                                        <label  class="control-label mb-1">Gender</label>
                                        <select name="gender"  class="form-control  @error('gender')   is-invalid   @enderror" >
                                            {{-- <option value="">Choose Gender</option> --}}
                                            <option value="male"  @if ($user->gender == 'male') selected     @endif>Male</option>
                                            <option value="female"  @if ($user->gender == 'female')   selected       @endif>Female</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror

                            <div class="form-group col-10 me-2">
                                <label for="address" class="control-label mb-1">Address</label> <br>
                               <textarea name="address" class="form-control  @error('address')   is-invalid   @enderror" id="address" placeholder="Enter Admin Address" cols="10" rows="5"> {{old('address',$user->address)}} </textarea>
                               @error('address')
                               <div class="invalid-feedback text-danger">{{$message}}</div>
                           @enderror
                            </div>




                                </div>
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
