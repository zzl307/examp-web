<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <title>exands 镜像配置平台 @yield('title')</title>
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="{{asset('plugins/jquery-ui/jquery.ui.1.10.2.ie.css')}}"/>
        <![endif]-->
        <link href="{{asset('static/css/main.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('static/css/plugins.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('static/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('static/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('static/css/fontawesome/font-awesome.min.css')}}">
        <link href="{{asset('static/css/simditor.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('static/css/spinners.css')}}" rel="stylesheet" type="text/css"/>
        <!--[if IE 7]>
            <link rel="stylesheet" href="{{asset('static/css/fontawesome/font-awesome-ie7.min.css')}}">
        <![endif]-->
        <!--[if IE 8]>
            <link href="{{asset('static/css/ie8.css')}}" rel="stylesheet" type="text/css" />
        <![endif]-->
        @section('style')
            <style>
                .widget-content.no-padding .dataTables_header{
                    border-top: 1px solid #ddd;
                }
				a:visited {
					color: #908f90;
				}
            </style>
        @show
    </head>
    
    <body>
        @section('header')
            <header class="header navbar navbar-fixed-top" role="banner">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <li class="nav-toggle">
                            <a href="javascript:void(0);" title="">
                                <i class="icon-reorder">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        exands 镜像配置平台
                    </a>
                    <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
                        <i class="icon-reorder">
                        </i>
                    </a>
                </div>
            </header>
        @show

        <div id="container">
            <div id="sidebar" class="sidebar-fixed">
                <div id="sidebar-content">

                    <!-- 左侧导航栏 -->
                    @include('common.leftNav')

                </div>
                <div id="divider" class="resizeable">
                </div>
            </div>

            <div id="content">
                <div class="container">
					<div style='height: 12px'></div>
                    @section('content')
                    @show
                </div>
            </div>
        </div>
        
        @include('common.commonJs')
        
        @section('javascript')

        @show    

    </body>
</html>
