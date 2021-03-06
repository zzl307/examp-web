<!-- 成功提示框 -->
@if(Session::has('success'))
	<div class="alert alert-success fade in">
		<i class="icon-remove close" data-dismiss="alert">
		</i>
		<strong>
		    成功!
		</strong>
		{{Session::get('success')}}
	</div>
@endif

<!-- 失败提示框 -->
@if(Session::has('error'))
	<div class="alert alert-danger fade in">
		<i class="icon-remove close" data-dismiss="alert">
		</i>
		<strong>
			失败!
		</strong>
		{{Session::get('error')}}
	</div>
@endif