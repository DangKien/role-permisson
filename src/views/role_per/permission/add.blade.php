@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{{ trans('backend.permission.lable') }}</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">{{ trans('backend.permission.add') }}</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel">
			            <div class="panel-heading">
			               
			            </div>
			            @if (!isset($permission)) 
							<form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
							@method ('POST')
						@else
							<form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
								@method ('PUT')
			            @endif

			            	@csrf
			            	
			                <div class="panel-body col-sm-offset-2">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{{ trans('backend.permission.name') }}</label>
			                                <input type="text" name="name" class="form-control" 
			                                value="{{ old('name') ? old('name') :  @$permission->name }}">
			                                @if ($errors->has('name'))
				                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
				                            @endif
			                            </div>
			                        </div> 
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{{ trans('backend.permission.display_name') }}</label>
			                                <input type="text" name="display_name" class="form-control" value="{{ old('display_name') ? old('display_name') : @$permission->display_name }}">
			                                @if ($errors->has('display_name'))
				                            	<p class="text-left text-danger">{{ $errors->first('display_name') }}</p>
				                            @endif
			                            </div>
			                        </div>

			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{{ trans('backend.permission.description') }}</label>
			                                <input type="text" name="description" class="form-control" value="{{ old('description') ? old('description') : @$permission->description }}">
			                                @if ($errors->has('description'))
				                            	<p class="text-left text-danger">{{ $errors->first('description') }}</p>
				                            @endif
			                            </div>
			                        </div>
									@php 
										$per_gr = \App\Models\PermissionGroup::all();
									@endphp
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <p>{{ trans('backend.permission.group_permission') }}</p>
                                            <select id="demo-select2" name="per_gr" class=" demo-select2 selected-2" style="width: 100%;">
                                            	@foreach ($per_gr as $key => $gr) 
													<option 
														@if(  $gr->id == old('per_gr') || $gr->id == @$permission->permission_group->id) 
															{{"selected"}}
														@endif
														value="{{ $gr->id }}"
													> {!! $gr->display_name !!}</option>}
                                            	@endforeach
                                            </select>
                                        </div>
                                    </div>
			                    </div>
			                    <div class="row">
			                    	<div class="col-sm-10">
			                        	<button type="submit" class="btn btn-primary btn-block">{{ trans('backend.actions.submit') }}</button>
			                        </div>
			                    </div>
			                </div>
			                
					   	</form>
			        </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script>
		$(document).ready(function() {
		    $('.selected-2').select2();
		});
	</script>
@endsection

@section ('myCss')
	
@endsection

