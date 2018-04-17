<style>
	#sidebar{
		width: 206px;
	}
	#sidebar ul#nav ul.sub-menu a{
		padding: 12px 15px 12px 46px;
	}
	#content{
        margin-left: 206px;
    }
</style>
<!-- 左侧导航栏 -->
<ul id="nav">
	<li class="@if(Request::segment(1) == 'userList') current @endif">
		<a href="{{ url('userList/userListRefresh') }}">
			<i class="icon-user">
			</i>
			终端信息
		</a>
	</li>
	<li class="@if(Request::segment(1) == 'system') current @endif">
		<a href="{{ url('system/systemConfigRefresh') }}">
			<i class="icon-building">
			</i>
			系统配置
		</a>
	</li>
</ul>
