
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>Quality Control Panel | WR-Reserve </title>

		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ URL::asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ URL::asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ URL::asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{ URL::asset('assets/media/logos/favicon.ico') }}" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->

		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
        @section('sidebar')
          @include('layout.sidebar')
          @show
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					@section('navbar')
                      @include('layout.header')
                    @show
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								@section('subheader')
								 @show
								<!--end::Info-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
							<!--begin::Dashboard-->
							   @yield('content')	
							<!--end::Dashboard-->
									<!--begin::Modal-->
									@yield('extra-container')
									<!--end::Main-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->

		<!-- begin::User Panel-->
		@section('profile')
		  @include('layout.profile')
              @show
		<!-- end::User Panel-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Sticky Toolbar-->
		@section('rigthbar')
		  @include('layout.stickybar')
              @show
		<!--end::Sticky Toolbar-->
		<!--begin::Demo Panel-->
		<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
				<h4 class="font-weight-bold m-0">Select A Demo</h4>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content">
				<!--begin::Wrapper-->
				<div class="offcanvas-wrapper mb-5 scroll-pull">
					<h5 class="font-weight-bold mb-4 text-center">Demo 1</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo offcanvas-demo-active">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo1.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo1/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo1/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 2</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo2.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo2/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo2/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 3</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo3.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo3/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo3/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 4</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo4.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo4/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo4/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 5</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo5.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo5/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo5/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 6</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo6.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo6/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo6/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 7</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo7.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo7/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo7/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 8</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo8.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo8/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo8/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 9</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo9.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo9/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo9/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 10</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo10.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo10/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo10/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 11</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo11.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo11/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo11/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 12</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo12.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo12/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo12/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 13</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo13.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="../../demo13/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
							<a href="https://preview.keenthemes.com/metronic/demo13/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 14</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo14.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 15</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo15.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 16</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo16.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 17</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo17.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 18</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo18.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 19</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo19.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 20</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo20.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 21</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo21.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 22</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo22.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 23</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo23.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 24</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo24.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 25</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo25.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 26</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo26.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 27</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo27.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 28</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo28.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 29</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo29.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
					<h5 class="font-weight-bold mb-4 text-center">Demo 30</h5>
					<div class="overlay rounded-lg mb-8 offcanvas-demo">
						<div class="overlay-wrapper rounded-lg">
							<img src="assets/media/demos/demo30.png" alt="" class="w-100" />
						</div>
						<div class="overlay-layer">
							<a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming soon</a>
						</div>
					</div>
				</div>
				<!--end::Wrapper-->
				<!--begin::Purchase-->
				<div class="offcanvas-footer">
					<a href="https://1.envato.market/EA4JP" target="_blank" class="btn btn-block btn-danger btn-shadow font-weight-bolder text-uppercase">Buy Metronic Now!</a>
				</div>
				<!--end::Purchase-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Demo Panel-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ URL::asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ URL::asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ URL::asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="{{ URL::asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ URL::asset('assets/js/pages/widgets.js') }}"></script>
		<script src="{{ URL::asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
		<script src="{{ URL::asset('assets/js/labels.js') }}"></script>
		<script src="{{ URL::asset('assets/js/quasystems.js') }}"></script>
		<script src="{{ URL::asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
		<script src="{{ URL::asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
		@section('extrajs')
          @show
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>