@extends('admin.layouts.master')

@section('title','Category | List')
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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#categoryPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
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
                    <form action="{{route('admin#list')}}" method="GET">
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
                    <h3><i class="fa-solid fa-database mr-2"></i>  {{$admins->total()}} </h3>
                </div>
             </div>

            {{-- @if (count($categories) != 0) --}}
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                @foreach ($admins as $admin)

                        <tr class="tr-shadow">
                                                                    <input type="hidden" class="userId" id="userId" value="{{$admin->id}}">

                            <td class="col-2">
                                <div >
                                    @if ($admin->image==null)

                                        @if($admin->gender =='male')
                                        <img     src="{{asset('image/default-user.jpeg')}}" alt="John Doe"
                                        class="img-thumbnail shadow-sm" />
                                        @else
                                        <img     src="{{asset('image/default-user-girl.jpeg')}}" alt="John Doe"
                                        class="img-thumbnail shadow-sm" />
                                        @endif
                                    @else

                                    <img src="{{asset('storage/'.$admin->image)}}" class="img-thumbnail shadow-sm" alt=" " />

                                    @endif
                                </div>
                            </td>
                            <td >{{$admin->name}} </td>
                            <td >{{$admin->email}}</td>
                            <td >{{$admin->gender}}</td>
                            <td >{{$admin->phone}}</td>
                            <td >{{$admin->address}}</td>
                            <td>
                                <div class="table-data-feature me-5">



                             @if($admin->id != Auth::user()->id)
                                   <select name="" id="" class="form-control statusChange">
                                    <option @if($admin->role == "user" ) selected @endif value="user">User</option>
                                <option @if($admin->role == "admin" ) selected @endif value="admin">Admin</option>
                                </select>

                             <a href="{{route('admin#changeRole',$admin->id)}}">
                             <button class="item mr-1" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                <i class="fa-solid fa-person-circle-minus"></i>
                            </button>
                         </a>
                             <a href="{{route('admin#delete',$admin->id)}}">
                             <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                         </a>
                             @else

                             @endif

                                </div>

                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            <div class="">
                {{$admins->links()}}
                {{-- first way to fix paginating --}}
                {{-- {{$categories->appends(request()->query())->links()}} --}}
            </div>
            </div>



            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection

@section('scriptSection')

<script>
    $(document).ready(function(){


        $('.statusChange').change(function (){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');

            $userId =$parentNode.find('.userId').val();


            console.log($currentStatus);
            console.log($userId);
            $.ajax({
                type: "get",
                url: "/admin/change/role/ajax",
                data : {
                    "role": $currentStatus,
                    "userId": $userId,

            },
                dataType: 'json',
                success : function (response){
                }

            })
            // window.location.href ="/order/list";
            location.reload();


        })
    });
</script>

@endsection
{{--  --}}
