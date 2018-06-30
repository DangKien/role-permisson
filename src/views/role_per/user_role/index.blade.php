@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Người dùng</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">Role</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		    	<div class="col-sm-6">
			        <div class="panel">
			            <div class="panel-heading">
			                
			            </div>
			            @php
							$roles = \App\Models\Role::all();

			            @endphp
			            <div class="panel-body">
			            	<form action="{{ route('user-permission.store', $user->id) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
			            		@csrf
			            		@method ('POST')
    			            	<p class="text-main text-bold mar-no">Quyền cho users</p>
    			            	<select multiple="multiple" class="form-control selected-2" name="roles[]">
    		            	        @foreach ($roles as $key => $role) 	
    									<option @foreach ($user->roles as $user_role) 
	    										@if($role->id == $user_role->id)
	    											{{ 'selected' }} 
	    											@break 
	    										@endif 
											@endforeach
											value="{{ $role->id }}">
    										{{ $role->display_name }}
    									</option>
    									
    		            	        @endforeach
    			            	</select>
    			            	<br>
    			            	<br>
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

