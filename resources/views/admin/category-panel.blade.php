@extends('layouts.app')
@section('title') Category panel @endsection
{{--<script>--}}
{{--    $(document).ready(function(){--}}
{{--        // Activate tooltip--}}
{{--        $('[data-toggle="tooltip"]').tooltip();--}}

{{--        // Select/Deselect checkboxes--}}
{{--        var checkbox = $('table tbody input[type="checkbox"]');--}}
{{--        $("#selectAll").click(function(){--}}
{{--            if(this.checked){--}}
{{--                checkbox.each(function(){--}}
{{--                    this.checked = true;--}}
{{--                });--}}
{{--            } else{--}}
{{--                checkbox.each(function(){--}}
{{--                    this.checked = false;--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--        checkbox.click(function(){--}}
{{--            if(!this.checked){--}}
{{--                $("#selectAll").prop("checked", false);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
@section('main')

    <div class="container mt-5">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Categories</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(session('success_message'))
                        <div class="alert alert-success success-message">
                            {{ session()->get('success_message') }}
                        </div>
                    @endif
                    @if(session('error_message'))
                        <div class="alert alert-danger error-message">
                            {{ session()->get('error_message') }}
                        </div>
                    @endif
                    @foreach($categories as $index => $category)
                        <tr>
                            <td>
					    		<span class="custom-checkbox">
					    			<input type="checkbox" id="checkbox{{$index}}" name="options[]" value="1">
					    			<label for="checkbox{{$index}}"></label>
					    		</span>
                            </td>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="#editEmployeeModal" data-id="{{$category->id}}" class="edit" data-toggle="modal"     data-name="{{$category->name}}"  ><i class="material-icons"     data-id="{{$category->id}}" data-name="{{$category->name}}" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" data-id="{{$category->id}}" class="delete" data-toggle="modal" data-name="{{$category->name}}" ><i class="material-icons" data-id="{{$category->id}}" data-name="{{$category->name}}" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center pagination-div">
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{route('admin.category.create')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group @error('name') is-invalid @enderror ">
                            <label for="create-name">Name</label>
                            <input type="text" class="form-control" id="create-name" name="name" required>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <script>
        $(document).ready(function (){
            $('.edit').click(function () {
                $('#update-name').val($(this).attr('data-name'))
                $('#update-id').val($(this).attr('data-id'))
            })
        })
    </script>
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{route('admin.category.update')}}" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" required name="id" id="update-id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required name="name" id="update-name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input id="edit-submit" type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-danger"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
