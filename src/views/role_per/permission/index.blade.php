@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Permission</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">List</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel-heading">
		                
		            </div>
		            <div class="panel-body">
		            	<div class="pad-btm form-inline">
				            <div class="row">
				                <div class="col-sm-6 table-toolbar-left">
				                   <a href="{{ route('permissions.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> Add Permission</a>
				                </div>
				                <div class="col-sm-6 table-toolbar-right">
				                    <div class="form-group col-sm-12">
				                        <input id="demo-input-search2" type="text" placeholder="Tìm kiếm" class="form-control col-sm-
				                        8" autocomplete="off">
				                    </div>
				                </div>
				            </div>
				        </div>
		                <div class="table-responsive">
		                	@php
		                		$permissions = App\Models\Permission::with('permission_group')->paginate(30);
		                	@endphp
		                    <table class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>Mã Role</th>
		                                <th>Tên hiện thị</th>
		                                <th>Nhóm quyền </th>
		                                <th>Mô tả về quyền</th>
		                                <th>Thao tác</th>
		                            </tr>
		                        </thead>
		                        <tbody>
	                            	@foreach ($permissions as $key => $permission) 
	                            	<tr>
		                                <td class="text-center"> {{ $key + 1 }} </td>
		                                <td>{{ $permission->name }}</td>
		                                <td>{{ $permission->display_name }}</td>
		                                <td>{{ $permission->permission_group->display_name }}</td>
		                                <td>{{ $permission->description }}</td>
		                                <td class="text-center" style="width: 100px;">
			                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
			                                	<a class="btn btn-sm btn-info btn-icon" href="{{ route('permissions.edit', $permission->id) }}">
			                                		<i class="fa fa-edit icon-lg"></i>
			                                	</a>
			                                    @csrf
			                                    @method('DELETE')
			                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash icon-lg"></i></button>
			                                </form>
			                            </td>
		                            </tr>
		                            @endforeach
		                        </tbody>
		                    </table>
		                    	{{ $permissions->links() }}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
@endsection

@section ('myCss')
	
@endsection

