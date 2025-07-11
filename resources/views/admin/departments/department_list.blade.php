@extends('admin.layouts.master')

@section('title', 'KaleidoLearn | Subjects')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('departments') !!}
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
                        <h2>Subjects List</h2>
                        <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal"
                                style="border-radius: 15px; background-color: #f9c130; padding: 10x 15px; font-size: 15px; color: #fff; border: none;">
                            <img src="{{ asset('static/assets/images/flower-center2.svg') }}" style="width: 20px; margin-right: 5px"/>  @if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN)
                                                            Add Subject
                                                       @else
                                                           Request new subject
                                                        @endif
                        </button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($departments)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry!</strong> No Data Found.
                            </div>
                        @else
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data" style="border-radius: 10px;">
                            <thead style="background: #f05227; color: #fff;">
                            <tr>
                                <th>Subject ID</th>
                                <th>Title</th>
                                <th>Subject Code</th>
                                <th>Status</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN)
                                <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td><strong>{{ ++$index }}</strong></td>
                                    <td>{{ $department->title }}</td>
                                    <td>{{ $department->short_code }}</td>
                                    <td>
                                        @if($department->status == \App\Libraries\Enumerations\DepartmentStatus::$PENDING)
                                            <span class="label label-default">Pending</span>
                                        @elseif($department->status == \App\Libraries\Enumerations\DepartmentStatus::$APPROVED)
                                            <span class="label label-success">Approved</span>
                                        @elseif($department->status == \App\Libraries\Enumerations\DepartmentStatus::$APPROVED)
                                            <span class="label label-warning">Banned</span>
                                        @else

                                        @endif
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN)
                                    <td class="text-center">
                                        <button type="button" style="border-radius: 5px; background-color: #2172b9; "
                                                data-id="{{ $department->id }}"
                                                data-title="{{ $department->title }}"
                                                data-short_code="{{ $department->short_code }}"
                                                data-status="{{ $department->status }}"
                                                data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>

                                      <a href="{{route('departments-delete', ['id'=>$department->id])}}" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm" style="border-radius: 5px; background-color: #e23506"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                    </td>
                                    @endif
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
        <div class="modal fade" id="updateModal" role="dialog"  style="top:20%">
            <div class="modal-dialog" style="background-color: #f05227; border-radius: 10px;">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header" style="background-color: #f05227; color: #fff; ">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Info</h4>
                    </div>
                    <form action="{{ route('departments-update') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <input type="hidden" name="modal_id" id="modal_id">
                                    <tr>
                                        <td colspan="2"><label>Title</label></td>
                                        <td colspan="2">
                                            <input type="text" name="title" class="form-control" id="modal_title" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Short Code</label></td>
                                        <td colspan="2">
                                            <input type="text" name="short_code" class="form-control" id="modal_short_code" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Status</label></td>
                                        <td colspan="2">
                                            <select class="form-control" name="status" id="modal_status">
                                                <option value="{{ \App\Libraries\Enumerations\DepartmentStatus::$APPROVED }}">Approve</option>
                                                <option value="{{ \App\Libraries\Enumerations\DepartmentStatus::$PENDING }}">Pending</option>
                                                <option value="{{ \App\Libraries\Enumerations\DepartmentStatus::$BANNED }}">Banned</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                    </form>
                    <div class="modal-footer" style="background-color:rgb(255, 255, 255);">
                        <button type="submit" class="btn btn-default pull-right" style="background-color: #f05227; color: #fff; border-radius: 10px;">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 10px;">Close</button>
                    </div>

                </div>

            </div>
        </div>
    {{--Update Modal End--}}

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog"  style="top:20%" >
            <div class="modal-dialog" style="background-color: #f05227; border-radius: 10px;">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header" style="background-color: #f05227; color: #fff; ">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Subject</h4>
                    </div>
                    <form action="{{ route('departments-add') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Title</label></td>
                                        <td colspan="2">
                                            <input type="text" name="title" class="form-control" id="name" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Subject Code</label></td>
                                        <td colspan="2">
                                            <input type="text" name="short_code" class="form-control" id="short_code" >
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                    </form>
                    <div class="modal-footer" style="background-color:rgb(255, 255, 255);">
                        <button type="submit" class="btn btn-default pull-right" style="background-color: #f05227; color: #fff; border-radius: 10px;">Submit</button>
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
            $('#modal_title').val($(e.relatedTarget).data('title'));
            $('#modal_short_code').val($(e.relatedTarget).data('short_code'));
            $('#modal_status').val($(e.relatedTarget).data('status'));
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