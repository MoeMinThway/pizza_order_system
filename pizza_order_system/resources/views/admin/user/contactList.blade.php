@extends('admin.layouts.master')

@section('title','Contact | List')
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
                            <h2 class="title-1">Contact List</h2>

                        </div>
                    </div>

                </div>
{{-- <h3>Total {{$users->total()}} --}}
</h3>







          <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>


                        <th>Name</th>
                        <th>Email </th>
                        <th>Message</th>
                        <th>Date</th>




                    </tr>
                </thead>

                <tbody id="dataList">

                 @foreach ($contacts as $c)
                    <tr>
                        <td> {{$c->name}} </td>
                        <td> {{$c->email}} </td>
                        <td> {{$c->message}} </td>
                        <td> {{$c->created_at->format('F-j-Y')}} </td>
                    </tr>

                 @endforeach



                </tbody>

            </table>
            <div class="mt-3">
                {{-- {{$users->links()}} --}}
            </div>

        </div>




                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
@section('scriptSection')


@endsection
{{--  --}}
