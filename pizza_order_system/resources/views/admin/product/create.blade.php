@extends('admin.layouts.master')

@section('title','Category | Create')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Pizza </h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf


                            <div class="form-group">
                                <label for="pizzaName" class="control-label mb-1">Name</label>
                                <input id="pizzaName " name="pizzaName" type="text"
                                 class="form-control     @error('pizzaName')   is-invalid   @enderror"
                                 value="{{old('pizzaName')}}"
                                aria-required="true" aria-invalid="false" placeholder="Enter  Pizza Name">
                            @error('pizzaName')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>



                            <div class="form-group">
                                <label for="category" class="control-label mb-1" class="form-control">Category</label>
                               <select name="pizzaCategory" id="category" class="form-control" >
                                <option value="{{old('pizzaCategory')}}">Choose your category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach


                               </select>
                            @error('category')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>



                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>

                                <textarea placeholder="Enter Pizza Description" name="pizzaDescription" id="description" cols="10" class="form-control  @error('pizzaDescription')   is-invalid   @enderror"  rows="5">{{old('pizzaPrice')}}</textarea>
                            @error('pizzaDescription')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image" class="control-label mb-1">Image</label>
                           <input type="file"
                           class="form-control     @error('pizzaImage')   is-invalid   @enderror"
                            name="pizzaImage" value="{{old('pizzaImage')}}">
                        @error('pizzaImage')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                        @enderror
                    </div>

                            <div class="form-group">
                                <label for="price" class="control-label mb-1">Waiting Time</label>
                                <input id="price " name="pizzaWaitingTime" type="number"
                                 class="form-control     @error('pizzaWaitingTime')   is-invalid   @enderror"
                                 value="{{old('pizzaWaitingTime')}}"
                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Waiting Time">
                            @error('pizzaWaitingTime')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                            <div class="form-group">
                                <label for="price" class="control-label mb-1">Price</label>
                                <input id="price " name="pizzaPrice" type="number"
                                 class="form-control     @error('pizzaPrice')   is-invalid   @enderror"
                                 value="{{old('pizzaPrice')}}"
                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                            @error('pizzaPrice')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>






                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create Pizza</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
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
