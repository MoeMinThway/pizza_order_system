@extends('user.layouts.master')

@section('content')

<h1 class="text-center"> Contact With Us</h1>
<form action="{{route('user#sendData')}}" class="mt-5">
    @csrf
<div class="row mt-3 offset-2">
    <div class="col-5"> <input name="name" type="text" class="name form-control" placeholder="Name"></div>
    <div class="col-5"> <input name="email" type="email" class="email form-control" placeholder="Email"></div>
</div>
<div class="row mt-3 offset-2">
    <div class="col-10">
        <textarea  name="message" id="" cols="30" rows="10" class="form-control" placeholder="Enter your Message"></textarea>
    </div>
</div>
<div class="row mt-3 offset-9">
    <div class="col-5 ">
        <input type="submit" class="btn btn-dark text-white " value="Send Message">
    </div>
</div>
</form>
@endsection

@section('scriptSource')

    {{-- <script>

        $(document).ready(function(){




    })
    </script> --}}


@endsection

