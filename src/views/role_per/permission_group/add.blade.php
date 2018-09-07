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
			<li><a href="#">{{ trans('backend.permission_group.add') }}</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel">
			            <div class="panel-heading">
			            </div>
		            	@if (!isset($per_gr))
		            		<form action="{{ route('permissions-group.store') }}" method="POST" enctype="multipart/form-data">
		            		@method ('POST')
		            	@else 
		            		<form action="{{ route('permissions-group.update', $per_gr->id) }}" method="POST" enctype="multipart/form-data">
		            		@method ('PUT')
		            	@endif
		            		@csrf
			                <div class="panel-body col-sm-offset-2">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{{ trans('backend.permission_group.code') }}</label>
			                                <input type="text" name="name" class="form-control" 
			                                value="{!! old('name') ? old('name') : @$per_gr->name !!}">
			                                @if ($errors->has('name'))
				                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
				                            @endif
			                            </div>
			                        </div> 
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{{ trans('backend.permission_group.display') }}</label>
			                                <input type="text" name="display_name" class="form-control" 
			                                value="{!! old('display_name') ? old('display_name') : @$per_gr->display_name !!}">
			                                @if ($errors->has('display_name'))
				                            	<p class="text-left text-danger">{{ $errors->first('display_name') }}</p>
				                            @endif
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
	
@endsection

@section ('myCss')
	
@endsection

