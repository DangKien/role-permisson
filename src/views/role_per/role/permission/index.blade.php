@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{{ trans('backend.role_premission.lable') }}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{{ trans('backend.actions.picker') }}</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel-heading">
		                
		            </div>
		            @php
						$per_gr = \App\Models\PermissionGroup::with('permissions')->get();
		            @endphp
		            <div class="panel-body">
		            	<form action="{{ route('roles-permission.store', @$role->id) }}" method="POST" accept-charset="utf-8">
		            		@csrf
		            		@foreach (@$per_gr as $key => $gr) 
		            			<div>
		            				<div class="panel-group accordion" id="demo-acc-info-outline">
							            <div class="panel panel-bordered panel-info">
							                <!--Accordion title-->
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" href="#demo-acd-info-outline-{{$key}}" aria-expanded="true" class="">{{ @$gr->display_name }}</a>
							                    </h4>
							                </div>
							
							                <!--Accordion content-->
							                <div class="panel-collapse collapse in" id="demo-acd-info-outline-{{$key}}" aria-expanded="true" style="">
							                    <div class="panel-body">
						                        	@foreach (@$gr->permissions as $key => $permission)
	    					            			<div class="col-sm-3 text-left">
	    					            				<div class="checkbox">
	    					            					<input id="{{ @$permission->name }}" class="magic-checkbox"
	    							                            type="checkbox" name="permission[]" 
	    							                            value="{{ @$permission->id }}"
	    														@foreach (@$role->permission_role as $role_per)
	    															@if ($role_per->id == @$permission->id)
	    																{{ 'checked' }}
	    															@endif
	    														@endforeach
	    							                            >
	    						                            <label for="{{ $permission->name }}">{{ $permission->display_name }}</label>
	    						                        </div>
	    					            			</div>
	    				            				@endforeach
							                    </div>
							                </div>
							            </div>
							        </div>
		            			</div>
				            @endforeach
				            <div class="row">
				            	<div class="col-sm-12">
				                	<button type="submit" class="btn btn-primary btn-block btn-form-submit"><i class="ti-save"></i></button>
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
