@extends('admin.layouts.master')

@section('title', 'KaleidoLearn | Manage Teachers')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                {!! Breadcrumbs::render('teachers') !!}

                @if(isset($errors))
                @if ( count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @endif
                @if(\Session::has('msg'))

                @endif

                <div class="x_panel">

                    <div class="x_title">
                        <h2>All Teachers List</h2>
                        <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal"
                                style="border-radius: 15px; background-color: #f05227; padding: 10x 15px; font-size: 15px; color: #fff; border: none;">
                            <img src="{{ asset('static/assets/images/flower.svg') }}" style="width: 20px; margin-right: 5px"/> Add Teacher
                        </button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($teachers)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry!</strong> No Teacher Data Found.
                            </div>
                        @else
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data" style="border-radius: 10px;">
                            <thead>
                            <tr style="background: #f49fc1; color: #fff;">
                                <th>Teacher ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td><strong>{{ ++$index }}</strong></td>
                                    <td><img src="{{ $teacher->picture }}" class="img-circle" alt="user image" height="40" width="40"></td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->iso.$teacher->phone }}</td>
                                    <td class="text-center">
                                        <button type="button" style="border-radius: 5px; background-color: #f9c130; "
                                                data-id="{{ $teacher->user_id }}"
                                                data-name="{{ $teacher->name }}"
                                                data-email="{{ $teacher->email }}"
                                                data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                      <a href="{{route('teachers-delete', ['id'=>$teacher->user_id])}}" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"  style="border-radius: 5px; background-color: #e23506"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                      <a href="{{route('teachers-courses', ['id'=>$teacher->user_id])}}"><button type="button" class="btn btn-info btn-sm" style="border-radius: 5px; background-color: #2172b9"><i class="fa fa-list" aria-hidden="true"></i> Show Courses</button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!--Update Modal -->
        <div class="modal fade" id="updateModal" role="dialog" style="top:20%">
            <div class="modal-dialog" style="background-color:#f49fc1; border-radius: 10px;">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header"  style="background-color: #f49fc1; color: #fff; ">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Info</h4>
                    </div>
                    <form action="{{ route('teachers-update') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <input type="hidden" name="modal_id" id="modal_id">
                                    <tr>
                                        <td colspan="2"><label>Name</label></td>
                                        <td colspan="2">
                                            <input type="text" name="name" class="form-control" id="modal_name" style="border-radius: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Email</label></td>
                                        <td colspan="2">
                                            <input type="text" name="email" class="form-control" id="modal_email"  style="border-radius: 10px;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                    </form>
                    <div class="modal-footer"  style="background-color:rgb(255, 255, 255);">
                        <button type="submit" class="btn btn-default pull-right" style="background-color: #f49fc1; color: #fff; border-radius: 10px;">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 10px;">Close</button>
                    </div>

                </div>

            </div>
        </div>
    {{--Update Modal End--}}

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog" style="top:20%" >
            <div class="modal-dialog" style="background-color: #f49fc1; border-radius: 10px;">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header" style="background-color: #f49fc1; color: #fff; ">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Teacher</h4>
                    </div>
                    <form action="{{ route('teachers-add') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Name</label></td>
                                        <td colspan="2">
                                            <input type="text" name="name" class="form-control" id="name" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Email</label></td>
                                        <td colspan="2">
                                            <input type="text" name="email" class="form-control" id="email" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Password</label></td>
                                        <td colspan="2">
                                            <input type="password" name="password" class="form-control" id="password" >
                                        </td>
                                    </tr>

                                </table>
                            </div>
                    </div>
                    </form>
                    <div class="modal-footer" style="background-color:rgb(255, 255, 255);">
                        <button type="submit" class="btn btn-default pull-right" style="background-color:#f49fc1; color: #fff; border-radius: 10px;">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 10px;">Close</button>
                    </div>

                </div>

            </div>
        </div>
    {{--add modal end--}}
@stop
<!-- /page content -->

@section('page_js')
    <script>
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_name').val($(e.relatedTarget).data('name'));
            $('#modal_email').val($(e.relatedTarget).data('email'));
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm"
                    },
                    {
                        extend: "csv",
                        className: "btn-sm"
                    },
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn-sm"
                    },
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
                responsive: true
            });
        });
    </script>
@stop