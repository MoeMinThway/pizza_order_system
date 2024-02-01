@extends('admin.layouts.master')

@section('title','Product | Update')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">

                        <div class=" ml-3">

                        <i class="fa-solid fa-arrow-left me-2 text-dark" onclick="history.back()" style="cursor: pointer"></i>
                    </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Pizza  </h3>
                        </div>

                        <form action="{{route('product#update')}}" enctype="multipart/form-data" method="POST">
@csrf
                            <div class="row">
                                <div class="col-4 offset-1 ">
                                    <input type="hidden" name="pizzaId"  value="{{$pizza->id}}"">

                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" alt=" " />



                        <div class="mt-3">
                                <input type="file" name="pizzaImage" class="form-control col-12
                                @error('pizzaImage')   is-invalid   @enderror">
                                @error('pizzaImage')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>


                        <div class="mt-3 ">

                            <div class="mt-3">
                                <label for="view_count" class="control-label mb-1 ">View Count</label>

                                <input type="text" name="view_count" class="form-control col-12
                                @error('view_count')   is-invalid   @enderror" value="{{old('view_count',$pizza->view_count)}}" disabled>
                                @error('view_count')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                            <div class="mt-3">
                                <label for="created_at" class="control-label mb-1 ">Create At</label>

                                <input type="text" name="created_at" class="form-control col-12
                                @error('created_at')   is-invalid   @enderror" value="{{old('created_at',$pizza->created_at)}}" disabled>
                                @error('created_at')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>



                        </div>
                        <div class="mt-3">
                                <button type="submit" class="btn btn-dark text-white col-12" >
                                   Update Pizza    <i class="fa-solid fa-circle-arrow-up mx-2"></i>
                                </button>
                        </div>

                                </div>

                                <div class="row col-6 ">
                                    <div class="form-group col-10">
                                        <label for="pizzaName" class="control-label mb-1 ">Name</label>
                                        <input id="pizzaName " name="pizzaName" type="text"
                                        class="form-control @error('pizzaName')   is-invalid   @enderror"
                                        value="{{old('pizzaName',$pizza->name)}}"
                                     placeholder="Enter Pizza Name">
                                    @error('pizzaName')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                </div>
                                    <div class="form-group col-10">
                                        <label  class="control-label mb-1 ">Category</label>
                                        <select name="pizzaCategory" id="" class="form-control">
                                            <option value="">Choose Pizza Category</option>
                                           @foreach ($categories as $c)
                                                <option value="{{$c->id}}"   @if ($pizza->category_id == $c->id) selected  @endif >{{$c->name}}</option>
                                           @endforeach
                                        </select>
                                    @error('pizzaCategory')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                </div>


                                <div class="form-group col-10">
                                    <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                    <input id="pizzaPrice " name="pizzaPrice" type="number"
                                    class="form-control @error('pizzaPrice')   is-invalid   @enderror"
                                    value="{{old('pizzaPrice',$pizza->price)}}"
                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                                @error('pizzaPrice')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                            </div>

                            <div class="form-group col-10">
                                <label for="waiting_time" class="control-label mb-1">Waiting Time</label>
                                <input id="waiting_time " name="pizzaWaitingTime" type="number"
                                class="form-control  @error('pizzaWaitingTime')   is-invalid   @enderror"
                                value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}"
                            aria-required="true" aria-invalid="false" placeholder="Enter Pizza Waiting Time ">
                            @error('pizzaWaitingTime')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                        @enderror
                                    </div>



                            <div class="form-group col-10 me-2">
                                <label for="description" class="control-label mb-1">Description</label> <br>
                               <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription')   is-invalid   @enderror" id="description" placeholder="Enter Pizza Description" cols="10" rows="5"> {{old('pizzaDescription',$pizza->description)}} </textarea>
                               @error('pizzaDescription')
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
{{--
          "id" => 3
  "category_id" => 3
  "name" => "Mona Seafood"
  "description" => "Try to eat this one"
  "image" => "65bb26fa92d4dScreenshot 2023-10-18 201604.png"
  "price" => 32
  "waiting_time" => 8
  "view_count" => 0
  "created_at" => "2024-02-01T05:07:06.000000Z"
  "updated_at" => "2024-02-01T05:07:06.000000Z"
    --}}
