@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Roles - Permission</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">Pick Permission</a></li>
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
				            	<div class="row" style="margin-bottom: 50px;">
				            		<div class="col-sm-12 panel-title">
				            			<p class="text-main text-bold mar-no"> {{ @$gr->display_name }} </p>
				            		</div>
				            		<div class="col-sm-12">
				            			@foreach (@$gr->permissions as $key => $permission)
					            			<div class="col-sm-3 text-center">
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
				            	<hr/>
				            @endforeach
				            <div class="row">
				            	<div class="col-sm-12">
				                	<button type="submit" class="btn btn-primary btn-block">Gửi</button>
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

