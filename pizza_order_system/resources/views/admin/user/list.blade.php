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
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>

                </div>
<h3>Total {{$users->total()}}</h3>







          <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>

                        <th>Image</th>
                        <th>Name</th>
                        <th>Email </th>
                        <th>Gender</th>
                        <th>phone</th>
                        <th>Address</th>
                        <th>Role</th>



                    </tr>
                </thead>

                <tbody id="dataList">

                    @foreach ($users as $u)
                    <tr class="mb-3">
                        <input type="hidden" class="userId" id="userId" value="{{$u->id}}">
                        <td>
                        @if ($u->image==null)

                                        @if($u->gender =='male')
                                        <img     src="{{asset('image/default-user.jpeg')}}" width="150px" alt="John Doe"
                                        class="img-thumbnail shadow-sm" />
                                        @else
                                        <img     src="{{asset('image/default-user-girl.jpeg')}}" width="150px" alt="John Doe"
                                        class="img-thumbnail shadow-sm" />
                                        @endif
                                    @else

                                    <img src="{{asset('storage/'.$u->image)}}" class="img-thumbnail shadow-sm" width="150px" alt=" " />

                                    @endif
                        </td>
                        <td> {{$u->name}} </td>
                        <td> {{$u->email}} </td>
                        <td> {{$u->gender}} </td>
                        <td> {{$u->phone}} </td>
                        <td> {{$u->address}} </td>
                        <td>
                            {{-- {{$u->role}} --}}

                            <select name="" id="" class="form-control statusChange">
                                <option @if($u->role == "user" ) selected @endif value="user">User</option>
                                <option @if($u->role == "admin" ) selected @endif value="admin">Admin</option>
                            </select>

                        </td>
                    </tr>

                    @endforeach



                </tbody>

            </table>
            <div class="mt-3">
                {{$users->links()}}
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
                url: "http://127.0.0.1:8000/user/change/role",
                data : {
                    "role": $currentStatus,
                    "userId": $userId,

            },
                dataType: 'json',
                success : function (response){
                }

            })
            // window.location.href ="http://127.0.0.1:8000/order/list";
            location.reload();


        })
    });
</script>

@endsection
{{--  --}}
