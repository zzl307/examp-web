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
		.panel-body{
			padding: 6px;
		}
	</style>
@stop

@section('menu')
	系统配置
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
						系统配置
					</h4>
					<div class="toolbar">
						<div class="btn-group">
							<span class="btn btn-xs" id="systemConfigRefresh">
								<i class="icon-refresh">
								</i>
							</span>
						</div>
					</div>
				</div>
				<div class="widget-content">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                    href="#device">
                                        数据镜像接口配置
                                    </a>
                                </h3>
                            </div>
                            <div id="device" @if(isset($data['device'])) class="panel-collapse collapse in" @else class="panel-collapse collapse" @endif>
                                <div class="panel-body">
                                    <table class="table table-hover table-striped table-bordered table-highlight-head table-checkable no-padding" style="border-top: 1px solid #ddd;">
										<tbody>
											<tr>
												<td class="col-md-2">
													数据镜像接口
												</td>
												<td>
													<a data-toggle="modal" href="#editMirrorModal" class="bs-tooltip" title="修改数据镜像接口">
														<span class="label label-info">
															{{ isset($systemConfig['mirror-device']) ? $systemConfig['mirror-device'] : '请点击添加数据镜像接口' }}
														</span>
													</a>
													<div class="modal fade" id="editMirrorModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		修改数据镜像接口
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/mirror') }}" method="post">

																	{{ csrf_field() }}
																	
																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				名称
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="mirror[mirror-device])" value="{{ isset($systemConfig['mirror-device']) ? $systemConfig['mirror-device'] : old('mirror')['mirror-device'] }}" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													数据发送接口
												</td>
												<td>
													<a data-toggle="modal" href="#editMirrorPostModal" class="bs-tooltip" title="修改数据发送接口">
														<span class="label label-info">
															{{ isset($systemConfig['write-device']) ? $systemConfig['write-device'] : '请点击添加数据发送接口' }}
														</span>
													</a>
													<div class="modal fade" id="editMirrorPostModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		修改数据发送接口
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/mirrorPost') }}" method="post">

																	{{ csrf_field() }}
																	
																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				名称
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="mirror[write-device])" value="{{ isset($systemConfig['write-device']) ? $systemConfig['write-device'] : old('mirror')['write-device'] }}" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
	                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                    href="#radius">
                                        Radius配置
                                    </a>
                                </h3>
                            </div>
                            <div id="radius" @if(isset($data['radius'])) class="panel-collapse collapse in" @else class="panel-collapse collapse" @endif>
                                <div class="panel-body">
                                    <table class="table table-hover table-striped table-bordered table-highlight-head table-checkable" style="border-top: 1px solid #ddd;">
                                    	<tbody>
                                    		<tr>
												<td>
													<div>
														Radius
														<a data-toggle="modal" href="#addRadiusModal">
															<i class="icon-plus bs-tooltip" title="添加Radius" style="float: right">
															</i>
														</a>
													</div>
													<div class="modal fade" id="addRadiusModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		新增Radius
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/radius') }}" method="post">

																	{{ csrf_field() }}

																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				名称
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="radius[name]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				服务器地址
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="radius[server]" required>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				密码
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="radius[secret]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				Radius认证端口
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="radius[port]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				Radius计费端口
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="radius[acctport]" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
												<td style="padding: 0;margin: 0;">
													<table class="table table-hover table-striped table-highlight-head table-checkable">
														<thead>
															<th>
																名称
															</th>
															<th>
																服务器地址
															</th>
															<th>
																密码
															</th>
															<th>
																Radius认证端口
															</th>
															<th>
																Radius计费端口
															</th>
															<th>
																
															</th>
														</thead>
														<tbody>
															@if(isset($systemConfig['radius']))
																@foreach($systemConfig['radius'] as $key => $vo)
																	<tr>
																		<td>
																			{{ $vo['name'] }}
																		</td>
																		<td>
																			{{ $vo['server'] }}
																		</td>
																		<td>
																			{{ $vo['secret'] }}
																		</td>
																		<td>
																			{{ $vo['port'] }}
																		</td>
																		<td>
																			{{ $vo['acctport'] }}
																		</td>
																		<td>
																			<a data-toggle="modal" href="#editRadiusModal_{{ $key }}" class="bs-tooltip" title="修改Radius">
																				<i class="icon-edit">
																				</i>
																			</a>
																			<div class="modal fade" id="editRadiusModal_{{ $key }}">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																								&times;
																							</button>
																							<h4 class="modal-title">
																								修改Radius
																							</h4>
																						</div>

																						<form class="form-horizontal row-border" action="{{ url('system/radiusEdit') }}" method="post">

																							{{ csrf_field() }}
																							
																							<input type="hidden" name="id" value="{{ $key }}">
																							<div class="modal-body">
																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										名称
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="radius[name]" value="{{ old('radius')['name'] ? old('radius')['name'] : $vo['name'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										服务器地址
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="radius[server]" value="{{ old('radius')['server'] ? old('radius')['server'] : $vo['server'] }}" required>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										密码
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="radius[secret]" value="{{ old('radius')['secret'] ? old('radius')['secret'] : $vo['secret'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										Radius认证端口
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="radius[port]" value="{{ old('radius')['port'] ? old('radius')['port'] : $vo['port'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										Radius计费端口
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="radius[acctport]" value="{{ old('radius')['acctport'] ? old('radius')['acctport'] : $vo['acctport'] }}" required autofocus>
																									</div>
																								</div>
																							</div>

																							<div class="modal-footer">
																								<button type="button" class="btn btn-default" data-dismiss="modal">
																									取消
																								</button>
																								<button type="submit" class="btn btn-primary">
																									确定
																								</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																			&nbsp;
																			<a href="{{ url('system/radiusDelete', ['id' => $key]) }}" class="bs-tooltip" title="删除" onclick="if(confirm('确定删除') == false) return false;">
																				<i class="icon-trash">
																				</i>
																			</a>
																		</td>
																	</tr>
																@endforeach
															@else
																<td>
																	没有数据
																</td>
															@endif
														</tbody>
													</table>
												</td>
											</tr>
                                    	</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                    href="#portal">
                                        Portal配置
                                    </a>
                                </h3>
                            </div>
                            <div id="portal" @if(isset($data['portal'])) class="panel-collapse collapse in" @else class="panel-collapse collapse" @endif>
                                <div class="panel-body">
                                    <table class="table table-hover table-striped table-bordered table-highlight-head table-checkable" style="border-top: 1px solid #ddd;">
                                    	<tbody>
                                    		<tr>
												<td>
													<div>
														Portal
														<a data-toggle="modal" href="#addPortalModal">
															<i class="icon-plus bs-tooltip" title="添加Portal" style="float: right">
															</i>
														</a>
													</div>
													<div class="modal fade" id="addPortalModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		新增Portal
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/portal') }}" method="post">

																	{{ csrf_field() }}

																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				名称
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="portal[name]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				服务器地址
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="portal[server]" required>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				Radius
																			</label>
																			<div class="col-md-8">
																				<select class='form-control col-md-12 full-width-fix' name='portal[radius]' style='width: 10%;'  required autofocus>
																					<option value=''>请选择Radius</option>
																					@foreach ($systemConfig['radius'] as $vo)
																						<option value="{{ $vo['name'] }}">{{ $vo['name'] }}</option>
																					@endforeach
																				</select>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				radius-acct
																			</label>
																			<div class="col-md-8">
																				<select class='form-control col-md-12 full-width-fix' name='portal[radius-acct]' style='width: 10%;'  required autofocus>
																					<option value=''>请选择radius-acct</option>
																					@foreach ($systemConfig['radius'] as $vo)
																						<option value="{{ $vo['name'] }}">{{ $vo['name'] }}</option>
																					@endforeach
																				</select>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				radius-acct-interval
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="portal[radius-acct-interval]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				idle-timeout
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="portal[idle-timeout]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				session-timeout				
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="portal[session-timeout]" required autofocus>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				mac-auth
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="portal[mac-auth]" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
												<td style="padding: 0;margin: 0;">
													<table class="table table-hover table-striped table-highlight-head table-checkable">
														<thead>
															<th>
																名称
															</th>
															<th>
																服务器地址
															</th>
															<th>
																Radius
															</th>
															<th>
																radius-acct
															</th>
															<th>
																radius-acct-interval
															</th>
															<th>
																idle-timeout
															</th>
															<th>
																session-timeout
															</th>
															<th>
																mac-auth
															</th>
															<th>
																
															</th>
														</thead>
														<tbody>
															@if(isset($systemConfig['hotspot']))
																@foreach($systemConfig['hotspot'] as $key => $vo)
																	<tr>
																		<td>
																			{{ $vo['name'] }}
																		</td>
																		<td>
																			{{ $vo['server'] }}
																		</td>
																		<td>
																			{{ $vo['radius'] }}
																		</td>
																		<td>
																			{{ $vo['radius-acct'] }}
																		</td>
																		<td>
																			{{ $vo['radius-acct-interval'] }}
																		</td>
																		<td>
																			{{ $vo['idle-timeout'] }}
																		</td>
																		<td>
																			{{ $vo['session-timeout'] }}
																		</td>
																		<td>
																			{{ $vo['mac-auth'] }}
																		</td>
																		<td>
																			<a data-toggle="modal" href="#editPortalModal_{{ $key }}" class="bs-tooltip" title="修改Portal">
																				<i class="icon-edit">
																				</i>
																			</a>
																			<div class="modal fade" id="editPortalModal_{{ $key }}">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																								&times;
																							</button>
																							<h4 class="modal-title">
																								修改Portal
																							</h4>
																						</div>

																						<form class="form-horizontal row-border" action="{{ url('system/portalEdit') }}" method="post">

																							{{ csrf_field() }}
																							
																							<input type="hidden" name="id" value="{{ $key }}">
																							<div class="modal-body">
																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										名称
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="portal[name]" value="{{ old('portal')['name'] ? old('portal')['name'] : $vo['name'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										服务器地址
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="portal[server]" value="{{ old('portal')['server'] ? old('portal')['server'] : $vo['server'] }}" required>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										Radius
																									</label>
																									<div class="col-md-8">
																										<select class='form-control col-md-12 full-width-fix' name='portal[radius]' style='width: 10%;'  required autofocus>
																											@foreach ($systemConfig['radius'] as $v)
																												@if($vo['radius'] == $v['name'])
																													<option value="{{ $v['name'] }}" selected="selected">{{ $v['name'] }}</option>
																												@else
																													<option value="{{ $v['name'] }}">{{ $v['name'] }}</option>
																												@endif
																											@endforeach
																										</select>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										radius-acct
																									</label>
																									<div class="col-md-8">
																										<select class='form-control col-md-12 full-width-fix' name='portal[radius-acct]' style='width: 10%;'  required autofocus>
																											@foreach ($systemConfig['radius'] as $v)
																												@if($vo['radius-acct'] == $v['name'])
																													<option value="{{ $v['name'] }}" selected="selected">{{ $v['name'] }}</option>
																												@else
																													<option value="{{ $v['name'] }}">{{ $v['name'] }}</option>
																												@endif	
																											@endforeach
																										</select>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										radius-acct-interval
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="portal[radius-acct-interval]" value="{{ old('portal')['radius-acct-interval'] ? old('portal')['radius-acct-interval'] : $vo['radius-acct-interval'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										idle-timeout
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="portal[idle-timeout]" value="{{ old('portal')['idle-timeout'] ? old('portal')['idle-timeout'] : $vo['idle-timeout'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										session-timeout				
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="portal[session-timeout]" value="{{ old('portal')['session-timeout'] ? old('portal')['session-timeout'] : $vo['session-timeout'] }}" required autofocus>
																									</div>
																								</div>

																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										mac-auth
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="portal[mac-auth]" value="{{ old('portal')['mac-auth'] ? old('portal')['mac-auth'] : $vo['mac-auth'] }}" required autofocus>
																									</div>
																								</div>
																							</div>

																							<div class="modal-footer">
																								<button type="button" class="btn btn-default" data-dismiss="modal">
																									取消
																								</button>
																								<button type="submit" class="btn btn-primary">
																									确定
																								</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																			&nbsp;
																			<a href="{{ url('system/portalDelete', ['id' => $key]) }}" class="bs-tooltip" title="删除" onclick="if(confirm('确定删除') == false) return false;">
																				<i class="icon-trash">
																				</i>
																			</a>
																		</td>
																	</tr>
																@endforeach
															@else
																<td>
																	没有数据
																</td>
															@endif
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													hotspot-profile
												</td>
												<td>
													<a data-toggle="modal" href="#editProfileModal" class="bs-tooltip" title="修改数据镜像接口">
														<span class="label label-info">
															{{ isset($systemConfig['hotspot-profile']) ? $systemConfig['hotspot-profile'] : '请点击添加hotspot-profile' }}
														</span>
													</a>
													<div class="modal fade" id="editProfileModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		修改hotspot-profile
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/hotspotProfile') }}" method="post">

																	{{ csrf_field() }}
																	
																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				名称
																			</label>
																			<div class="col-md-8">
																				<select class='form-control col-md-12 full-width-fix' name='profile[profile]' style='width: 10%;'  required autofocus>
																					@foreach ($systemConfig['hotspot'] as $v)
																						@if($systemConfig['hotspot-profile'] == $v['name'])
																							<option value="{{ $v['name'] }}" selected="selected">{{ $v['name'] }}</option>
																						@else
																							<option value="{{ $v['name'] }}">{{ $v['name'] }}</option>
																						@endif
																					@endforeach
																				</select>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
											</tr>
                                    	</tbody>
                                    	
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                    href="#whitelist_update">
                                        系统名单配置
                                    </a>
                                </h3>
                            </div>
                            <div id="whitelist_update" @if(isset($data['whitelist_update'])) class="panel-collapse collapse in" @else class="panel-collapse collapse" @endif>
                                <div class="panel-body">
                                    <table class="table table-hover table-striped table-bordered table-highlight-head table-checkable" style="border-top: 1px solid #ddd;">
										<tbody>
											<tr>
												<td class="col-md-2">
													<div>
														服务器白名单
														<a data-toggle="modal" href="#addServersModal">
															<i class="icon-plus bs-tooltip" title="添加服务器白名单" style="float: right">
															</i>
														</a>
													</div>
													<div class="modal fade" id="addServersModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		新增服务器白名单
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/servers') }}" method="post">
																	{{ csrf_field() }}

																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				IP地址/netmask
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="servers[ip-address]" placeholder="IP地址/netmask" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
												<td style="padding: 0;margin: 0;">
													<table class="table table-hover table-striped table-highlight-head table-checkable">
														<thead>
															<th>
																IP地址/netmask
															</th>
															<th>
																
															</th>
														</thead>
														<tbody>
															@if(isset($systemConfig['whitelist-servers']))
																@foreach($systemConfig['whitelist-servers'] as $key => $vo)
																	<tr>
																		<td class="col-md-2">
																			{{ $vo['ip-address'] }}/{{ $vo['netmask'] }}
																		</td>
																		<td>
																			<a data-toggle="modal" href="#editServersModal_{{ $key }}" class="bs-tooltip" title="修改服务器白名单">
																				<i class="icon-edit">
																				</i>
																			</a>
																			<div class="modal fade" id="editServersModal_{{ $key }}">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																								&times;
																							</button>
																							<h4 class="modal-title">
																								修改服务器白名单
																							</h4>
																						</div>

																						<form class="form-horizontal row-border" action="{{ url('system/serversEdit') }}" method="post">

																							{{ csrf_field() }}
																							
																							<input type="hidden" name="id" value="{{ $key }}">
																							<div class="modal-body">
																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										IP地址/netmask
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="servers[ip-address]" value="{{ old('servers')['ip-address'] ? old('servers')['ip-address'] : $vo['ip-address'].'/'.$vo['netmask'] }}" required autofocus>
																									</div>
																								</div>
																							</div>

																							<div class="modal-footer">
																								<button type="button" class="btn btn-default" data-dismiss="modal">
																									取消
																								</button>
																								<button type="submit" class="btn btn-primary">
																									确定
																								</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																			&nbsp;
																			<a href="{{ url('system/serversDelete', ['id' => $key]) }}" class="bs-tooltip" title="删除" onclick="if(confirm('确定删除') == false) return false;">
																				<i class="icon-trash">
																				</i>
																			</a>
																		</td>
																	</tr>
																@endforeach
															@else
																<td>
																	没有数据
																</td>
															@endif
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													<div>
														终端白名单
														<a data-toggle="modal" href="#addClientsModal">
															<i class="icon-plus bs-tooltip" title="添加终端白名单" style="float: right">
															</i>
														</a>
													</div>
													<div class="modal fade" id="addClientsModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		新增终端白名单
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/clients') }}" method="post">
																	{{ csrf_field() }}

																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				IP地址/netmask
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="clients[ip-address]" placeholder="IP地址/netmask" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
												<td style="padding: 0;margin: 0;">
													<table class="table table-hover table-striped table-highlight-head table-checkable">
														<thead>
															<th>
																IP地址/netmask
															</th>
															<th>
																
															</th>
														</thead>
														<tbody>
															@if(isset($systemConfig['whitelist-clients']))
																@foreach($systemConfig['whitelist-clients'] as $key => $vo)
																	<tr>
																		<td class="col-md-2">
																			{{ $vo['ip-address'] }}/{{ $vo['netmask'] }}
																		</td>
																		<td>
																			<a data-toggle="modal" href="#editClientsModal_{{ $key }}" class="bs-tooltip" title="修改终端白名单">
																				<i class="icon-edit">
																				</i>
																			</a>
																			<div class="modal fade" id="editClientsModal_{{ $key }}">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																								&times;
																							</button>
																							<h4 class="modal-title">
																								修改终端白名单
																							</h4>
																						</div>

																						<form class="form-horizontal row-border" action="{{ url('system/clientsEdit') }}" method="post">

																							{{ csrf_field() }}
																							
																							<input type="hidden" name="id" value="{{ $key }}">
																							<div class="modal-body">
																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										IP地址
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="clients[ip-address]" value="{{ old('clients')['ip-address'] ? old('clients')['ip-address'] : $vo['ip-address'].'/'.$vo['netmask'] }}" required autofocus>
																									</div>
																								</div>
																							</div>

																							<div class="modal-footer">
																								<button type="button" class="btn btn-default" data-dismiss="modal">
																									取消
																								</button>
																								<button type="submit" class="btn btn-primary">
																									确定
																								</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																			&nbsp;
																			<a href="{{ url('system/clientsDelete', ['id' => $key]) }}" class="bs-tooltip" title="删除" onclick="if(confirm('确定删除') == false) return false;">
																				<i class="icon-trash">
																				</i>
																			</a>
																		</td>
																	</tr>
																@endforeach
															@else
																<td>
																	没有数据
																</td>
															@endif
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													<div>
														网络黑名单
														<a data-toggle="modal" href="#addblackListModal">
															<i class="icon-plus bs-tooltip" title="添加网络黑名单" style="float: right">
															</i>
														</a>
													</div>
													<div class="modal fade" id="addblackListModal">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		&times;
																	</button>
																	<h4 class="modal-title">
																		新增网络黑名单
																	</h4>
																</div>

																<form class="form-horizontal row-border" action="{{ url('system/blackList') }}" method="post">
																	{{ csrf_field() }}

																	<div class="modal-body">
																		<div class="form-group">
																			<label class="col-md-3 control-label">
																				网络黑名单地址
																			</label>
																			<div class="col-md-8">
																				<input type="text" class="form-control" name="blackList[ip-address]" placeholder="网络黑名单地址" required autofocus>
																			</div>
																		</div>
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">
																			取消
																		</button>
																		<button type="submit" class="btn btn-primary">
																			确定
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
												<td style="padding: 0;margin: 0;">
													<table class="table table-hover table-striped table-highlight-head table-checkable">
														<thead>
															<th>
																网络黑名单地址
															</th>
															<th>
																
															</th>
														</thead>
														<tbody>
															@if(isset($systemConfig['blacklist']))
																@foreach($systemConfig['blacklist'] as $key => $vo)
																	<tr>
																		<td class="col-md-2">
																			{{ $vo }}
																		</td>
																		<td>
																			<a data-toggle="modal" href="#editblackListModal_{{ $key }}" class="bs-tooltip" title="修改网络黑名单地址">
																				<i class="icon-edit">
																				</i>
																			</a>
																			<div class="modal fade" id="editblackListModal_{{ $key }}">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																								&times;
																							</button>
																							<h4 class="modal-title">
																								修改网络黑名单地址
																							</h4>
																						</div>

																						<form class="form-horizontal row-border" action="{{ url('system/blackListEdit') }}" method="post">

																							{{ csrf_field() }}
																							
																							<input type="hidden" name="id" value="{{ $key }}">
																							<div class="modal-body">
																								<div class="form-group">
																									<label class="col-md-3 control-label">
																										网络黑名单地址
																									</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control" name="blackList[ip-address]" value="{{ old('blackList')['ip-address'] ? old('blackList')['ip-address'] : $vo }}" required autofocus>
																									</div>
																								</div>
																							</div>

																							<div class="modal-footer">
																								<button type="button" class="btn btn-default" data-dismiss="modal">
																									取消
																								</button>
																								<button type="submit" class="btn btn-primary">
																									确定
																								</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																			&nbsp;
																			<a href="{{ url('system/blackListDelete', ['id' => $key]) }}" class="bs-tooltip" title="删除" onclick="if(confirm('确定删除') == false) return false;">
																				<i class="icon-trash">
																				</i>
																			</a>
																		</td>
																	</tr>
																@endforeach
															@else
																<td>
																	没有数据
																</td>
															@endif
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
	                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer table-bordered">
							<button class="btn btn-primary" id="submit">
								确认提交
							</button>
						</div>
                    </div>
                </div>
			</div>
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		// 系统配置刷新
		$('#systemConfigRefresh').click(function(){
			window.location.href = '{{ url('system/systemConfigSubmit') }}';
		});

		$('#submit').click(function(){
			$.get('{{ url('system/systemSubmit') }}', function(data){
				if(data.errcode == 415){
					alert('数据配置错误请查看');
					window.location.href = '{{ url('system/systemConfigRefresh') }}';
				}
				if(data.errcode == 0){
					alert('修改成功, 重新搜索设备配置');
					window.location.href = '{{ url('system/systemConfigRefresh') }}';
				}
			})
		});
	</script>
@stop
