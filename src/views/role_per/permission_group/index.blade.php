@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{{ trans('backend.permission_group.lable') }}</h1>
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
				                   <a href="{{ route('permissions-group.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> {{ trans('backend.permission_group.add') }}</a>
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
		                		$per_grs = App\Models\PermissionGroup::paginate(30);
		                	@endphp
		                    <table class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>{{ trans('backend.permission_group.code') }}</th>
		                                <th>{{ trans('backend.permission_group.display_name') }}</th>
		                                <th>{{ trans('backend.actions.actions') }}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
	                            	@foreach ($per_grs as $key => $per_gr) 
	                            	<tr>
		                                <td class="text-center"> {{ $key + 1 }} </td>
		                                <td>{{ $per_gr->name }}</td>
		                                <td>{{ $per_gr->display_name }}</td>
		                                <td class="text-center" style="width: 100px;">
			                                <form action="{{ route('permissions-group.destroy', $per_gr->id) }}" method="POST">
			                                	<a class="btn btn-sm btn-info btn-icon" href="{{ route('permissions-group.edit', $per_gr->id) }}">
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
		                    	{{ $per_grs->links() }}
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

