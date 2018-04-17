@extends('common.layouts')

@section('style')
	<style>
		.widget-content.no-padding .dataTables_header{
			border-top: 1px solid #ddd;
		}
		code{
			display: block;
			float: left;
			padding: 0 8px;
			margin: 5px 5px 5px 5px;
			line-height: 23px;
			font-size: 11px;
			border: 0px;
			background: #fff;
		}
	</style>
@stop

@section('menu')
	场所状态
@stop

@section('content')

	<div class="row">
		<div class="col-md-12">

			@include('common.message')
			
			<div class="widget">
				<div class="widget-header">
					<h4>
						<i class="icon-reorder">
						</i>
						终端信息
					</h4>
					<div class="toolbar no-padding">
						<div class="btn-group">
							<span class="btn btn-xs" id="userListRefresh">
								<i class="icon-refresh">
								</i>
							</span>
						</div>
					</div>
				</div>
				@if(empty($userList))
					<div class="widget-content no-padding">
						<code>
							没有找到指定设备的配置信息！
						</code>
					</div>
				@else				
					<div class="widget-content">
						<table class="table table-hover table-striped table-bordered table-highlight-head table-checkable" style="border-top: 1px solid #ddd;">
							<thead>
								<tr>
									<th>
										终端MAC
									</th>
									<th class="col-md-2">
										IP
									</th>
									<th>
										登录时间
									</th>
									<th>
										活跃时间
									</th>
									<th>
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($userList as $key => $vo)
									<tr>
										<td>
											{{ $vo->client }}
										</td>
										<td>
											{{ $vo->ip }}
										</td>
										<td>
											{{ date('Y-m-d H:i:s', $vo->login_time) }}
										</td>
										<td>
											{{ date('Y-m-d H:i:s', $vo->active_time) }}
										</td>
										<td>
											<a href="javascript:;" onclick="getLogout('{{ $vo->ip }}')">
												<i class="icol-cross bs-tooltip" title="删除终端MAC">
												</i>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		// 终端信息刷新
		$('#userListRefresh').click(function(){
			window.location.href = '{{ url('userList/getUserListLogout') }}';
		});

		function getLogout(ip){
			$.get('{{ url('userList/getLogout') }}', {ip: ip}, function(data){
				if(data == 0){
					alert('删除成功');
					window.location.href = '{{ url('userList/getUserListLogout') }}';
				}
			})
		}
	</script>
@stop
