@extends('layouts.app')
@section('content')
	<div class="col-xl-16">
		<!--begin:: Widgets/Activity-->
		<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text m--font-light">
							Activity
						</h3>
					</div>
				</div>
				
			</div>
			<div class="m-portlet__body">
				<div class="m-widget17">
					<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
						<div class="m-widget17__chart" style="height:320px;">
							<canvas id="m_chart_activities"></canvas>
						</div>
					</div>
					<div class="m-widget17__stats">
						<div class="m-widget17__items m-widget17__items-col1">
							<div class="m-widget17__item">
								<a  href="{{route('leave.create')}}" class="m-nav__link">
								<span class="m-widget17__icon">
									<i class="m-menu__link-icon flaticon-interface-7"></i>
								</span>
								<span class="m-widget17__subtitle">
									Apply Form
								</span>
							
								</a>
							</div>
							
						</div>
						<div class="m-widget17__items m-widget17__items-col2">
							<div class="m-widget17__item">
								<a  href="{{route('leave.index')}}" class="m-nav__link">
								<span class="m-widget17__icon">
									<i class="m-menu__link-icon flaticon-folder"></i>
								</span>
								<span class="m-widget17__subtitle">
									My Leaves ss
								</span>
							
								</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Activity-->
	</div>
@endsection