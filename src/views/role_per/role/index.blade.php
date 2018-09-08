@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{{ trans('backend.role.lable') }}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{{ trans('backend.actions.list') }}</a></li>
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
				                   <a href="{{ route('roles.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> {{ trans('backend.actions.add') }}</a>
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
		                		$roles = App\Models\Role::paginate(30);
		                	@endphp
		                    <table class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>{{ trans('backend.role.code') }}</th>
		                                <th>{{ trans('backend.role.display_name') }}</th>
		                                <th>{{ trans('backend.role.desciption') }}</th>
		                                <th>{{ trans('backend.actions.actions') }}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
	                            	@foreach ($roles as $key => $role) 
	                            	<tr>
		                                <td class="text-center"> {{ $key + 1 }} </td>
		                                <td>{{ $role->name }}</td>
		                                <td>{{ $role->display_name }}</td>
		                                <td>{{ $role->description }}</td>
		                                <td class="text-center" style="width: 150px;">
			                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
			                                	<a class="btn btn-sm btn-info btn-icon" title="update"  href="{{ route('roles.edit', $role->id) }}">
			                                		<i class="fa fa-edit icon-lg"></i>
			                                	</a>
			                                	@if ( Auth::check() && ($role->name != config('roleper.superadmin')) || 
			                                	(Auth::user()->hasRole(config('roleper.superadmin')) && $role->name == config('roleper.superadmin'))  )
			                                	<a class="btn btn-sm btn-warning" title="permission" 
			                                	href="{{ route('roles-permission.index', $role->id) }}"><i class="fa fa-key"></i></a>
			                                	@endif
			                                    @csrf
			                                    @method('DELETE')
			                                    <button type="submit" title="delete"  class="btn btn-sm btn-danger"><i class="fa fa-trash icon-lg"></i></button>
			                                </form>
			                            </td>
		                            </tr>
		                            @endforeach
		                        </tbody>
		                    </table>
		                    	{{ $roles->links() }}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	@if (Session::has('role'))
	<script>
		$.toast({
		    heading: '{{ trans("backend.user_role.lable") }}',
		    text: '{{ Session::get("user_role") }}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection

@section ('myCss')
	
@endsection

