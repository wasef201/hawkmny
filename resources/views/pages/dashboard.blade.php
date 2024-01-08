
<x-panel padding="p-0" class="bg-transparent pt-5" >


	@switch(Auth::user()->type)
	@case(App\Models\User::ASSOCIATION)
	<div class="row">
		<div class="col-md-3">
			<div class="card card-xl-stretch">
				<!--begin::Body-->
				<div class="card-body p-0">
					<!--begin::Chart-->
					<div class="d-flex flex-center w-100">
						<div class="mixed-widget-17-chart" data-kt-chart-color="success"
						style="height: 300px; min-height: 178.469px;">
					</div>
				</div>
				<!--end::Chart-->
				<!--begin::Content-->
				<div class="text-center w-100 position-relative z-index-1" style="margin-top: -130px">
					<!--begin::Text-->
					<p class="fw-bold fs-4 text-gray-400 mb-6">مؤشر الحوكمة بناءاٍ علي اخر عملية تقييم</p>
					<!--end::Text-->
                        {{--<!--begin::Action-->
                        <div class="mb-9 mb-xxl-1">
                            <a href="#" class="btn btn-danger fw-bold" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_invite_friends">Increase Users</a>
                        </div>
                        <!--ed::Action-->--}}
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Body-->
                <!--ed::Info-->
            </div>
        </div>
        {{--@if ($last_in_progress_review && optional($last_in_progress_review->standards()->latest())->first())--}}
        <div class="col-md-9">
        	<!--begin::Tiles Widget 4-->
        	<div class="card h-100 card-xl-stretch">
        		<!--begin::Body-->
        		<div class="card-body d-flex align-items-center justify-content-between flex-wrap">
        			<div class="me-2">
        				<h2 class="fw-bolder text-gray-800 mb-3">  اكمل اختبار الحوكمة غير المنتهى  </h2>
        				<div class="text-muted fw-bold fs-6"> يمكنك الان اكمال اختبار الحوكه  </div>
        			</div>
        			<a href="{{ route('standard.review.create'  , $firstStandard ) }}" class="btn btn-primary fw-bold" >  {{ $last_in_progress_review ? 'اكمل' : 'ابدأ التقييم' }} </a>
        		</div>
        		<!--end::Body-->
        	</div>
        	<!--end::Tiles Widget 4-->
        </div>
       {{--// @endif--}}
        <div class="col-md-12">
        	<div class="card card-flush mt-6 mt-xl-9">

        		<div class="card-header mt-5">
        			<div class="card-title flex-column">
        				<h3 class="fw-bolder mb-1"> احدث تعليقات المشرف </h3>
        			</div>
        		</div>
        		<div class="card-body pt-0">
        			<div class="table-responsive">

        				<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">

        					<thead class="fs-7 text-gray-400 text-uppercase">
        						<tr>
        							<th class="min-w-250px"> المشرف </th>
        							<th class="min-w-150px"> التعليق </th>
        							<th class="min-w-90px"> تاريخ التعليق </th>
        							<th class="min-w-50px text-end">  </th>
        						</tr>
        					</thead>
        					<tbody class="fs-6">
        						@foreach ($comments as $comment)
        						<tr>
        							<td>
        								<div class="d-flex align-items-center">
        									<div class="d-flex flex-column justify-content-center">
        										<a href="" class="fs-6 text-gray-800 text-hover-primary"> {{ optional($comment->user)->name }} </a>
        									</div>
        								</div>
        							</td>
        							<td> {{ $comment->content }} </td>
        							<td> {{ $comment->created_at->diffForHumans() }} </td>

        							<td class="text-end">
        								<a href="{{ route('standard.review.create' , ['standard' => optional($comment->question)->standard_id ] ) }}" class="btn btn-light btn-sm"> عرض </a>
        							</td>
        						</tr>
        						@endforeach
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="col-md-12">
        	<div class="card card-flush mt-6 mt-xl-9">

        		<div class="card-header mt-5">
        			<div class="card-title flex-column">
        				<h3 class="fw-bolder mb-1">  التقييمات المكتمله </h3>
        			</div>
        		</div>
        		<div class="card-body pt-0">
        			<div class="table-responsive">

        				<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">

        					<thead class="fs-7 text-gray-400 text-uppercase">
        						<tr>
        							<th class="min-w-250px"> رقم التقييم </th>
        							<th class="min-w-150px">  عدد النقاط </th>
        							<th class="min-w-90px">  تاريخ البدىء </th>
        							<th class="min-w-90px">  اخر تحديث </th>
        						</tr>
        					</thead>
        					<tbody class="fs-6">
        						@foreach ($completed_reviews as $review)
        						<tr>
        							<td>
        								{{$review->id}}
        							</td>
        							<td> {{ $review->degree }} </td>
        							<td> {{ $review->created_at->diffForHumans() }} </td>
        							<td> {{ $review->updated_at->diffForHumans() }} </td>
        						</tr>
        						@endforeach
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
    @break
    @case(App\Models\User::SUPERVISOR)
    <div class="row">
    	<div class="col-md-4">
    		<a href="{{ route('association.index') }}" class="card bg-success hoverable card-xl-stretch mb-xl-8">
    			<!--begin::Body-->
    			<div class="card-body">
    				<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
    				<span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
    					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    						<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
    						<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
    						<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
    					</svg>
    				</span>
    				<!--end::Svg Icon-->
    				<div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"> {{ $associations_count }} </div>
    				<div class="fw-bold text-gray-100"> اجمالى عدد الجميعات </div>
    			</div>
    			<!--end::Body-->
    		</a>
    	</div>
    	    	<div class="col-md-4">
    		<a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
    			<!--begin::Body-->
    			<div class="card-body">
    				<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
    				<span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
    					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    						<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
    						<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
    						<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
    					</svg>
    				</span>
    				<!--end::Svg Icon-->
    				<div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"> {{ $my_reviews_which_i_comment_for_count }} </div>
    				<div class="fw-bold text-gray-100">  عدد التقييمات المعلق عليها </div>
    			</div>
    			<!--end::Body-->
    		</a>
    	</div>
    	    	<div class="col-md-4">
    		<a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
    			<!--begin::Body-->
    			<div class="card-body">
    				<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
    				<span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
    					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    						<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
    						<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
    						<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
    					</svg>
    				</span>
    				<!--end::Svg Icon-->
    				<div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"> {{ $my_comments_count }} </div>
    				<div class="fw-bold text-gray-100"> اجمالى عدد تعليقاتى </div>
    			</div>
    			<!--end::Body-->
    		</a>
    	</div>
    	<div class="col-md-12">
    		<x-card card-title="اجدد الجمعيات  فى نطاق اشرافى " >
    			<x-table >
    				<x-slot name="head">
    					<th class="px-2 text-start">الجمعية</th>
    					<th>التخصص</th>
    					<th>المنطقة</th>
    					<th>المدينة</th>
    					<th>رقم الترخيص</th>
    					<th>تاريخ الاتسجيل</th>
    				</x-slot>
    				<x-slot name="body">
    					@foreach($associations as $association)
    					<tr>
    						<td class="d-flex align-items-center">
    							<!--begin:: Avatar -->
    							<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    								<a href="{{ route('association.show' ,  $association) }}">
    									<div class="symbol-label fs-3 bg-light-success text-success">{{ mb_substr($association->name, 0, 1, 'utf8') }}</div>
    								</a>
    							</div>
    							<!--end::Avatar-->
    							<!--begin::User details-->
    							<div class="d-flex flex-column">
    								<a href="{{ route('association.show' , $association->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $association->name }}</a>
    								<a class="text-muted"><i class="bi-mailbox2"></i> {{ $association->email }}</a>
    								<a class="text-muted"><i class="bi-telephone-plus"></i>{{ $association->phone }}</a>
    							</div>
    							<!--begin::User details-->
    						</td>
    						<td class="text-center">{{ $association->section_text }}</td>
    						<td class="text-center">{{ optional($association->area)->name ?? '- - -'}}</td>
    						<td class="text-center">{{ optional($association->city)->name ?? '- - -'}}</td>
    						<td class="text-center">{{ $association->number }}</td>
    						<td class="text-center">{{ $association->created_at->toDateString() }}</td>

    					</tr>
    					@endforeach
    				</x-slot>
    			</x-table>
    		</x-card>
    	</div>
    	<div class="col-md-12 mt-5">
    		<x-card card-title="اجدد التليقات الخاصه بى  " >
    			<x-table >
    				<x-slot name="head">
    					<th> التعليق </th>
    					<th> التاريخ </th>
    					<th> السؤال </th>
    					<th> الجمعيه </th>
    				</x-slot>
    				<x-slot name="body">
    					@foreach($my_last_10_comments as $comment)
    					<tr>
    						<td class="d-flex align-items-center">
    							<!--begin:: Avatar -->
    							<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    								{{ $comment->content }}
    							</div>
    						</td>
    						<td class="text-center">{{ $comment->created_at->diffForHumans() }}</td>
    						<td class="text-center"> {{ optional($comment->question)->name }} </td>
    						<td class="text-center">{{ optional(optional($comment->review)->user)->name }}</td>

    					</tr>
    					@endforeach
    				</x-slot>
    			</x-table>
    		</x-card>
    	</div>
    </div>
    @break
    @endswitch



    @push('script')
    @if (Auth::user()->type == App\Models\User::ASSOCIATION )
    <script>
    	var e = document.querySelectorAll(".mixed-widget-17-chart");
    	[].slice.call(e).map((function (e) {
    		var t = parseInt(KTUtil.css(e, "height"));
    		if (e) {
    			var a = e.getAttribute("data-kt-chart-color"), o = {
    				labels: [''],
    				series: [{{ optional($last_in_progress_review)->governance_meter() ?? 0  }}],
    				chart: {fontFamily: "inherit", height: t, type: "radialBar", offsetY: 0},
    				plotOptions: {
    					radialBar: {
    						startAngle: -90,
    						endAngle: 90,
    						hollow: {margin: 0, size: "55%"},
    						dataLabels: {
    							showOn: "always",
    							name: {
    								show: !0,
    								fontSize: "12px",
    								fontWeight: "700",
    								offsetY: -5,
    								color: KTUtil.getCssVariableValue("--bs-gray-500")
    							},
    							value: {
    								color: KTUtil.getCssVariableValue("--bs-gray-900"),
    								fontSize: "24px",
    								fontWeight: "600",
    								offsetY: -40,
    								show: !0,
    								formatter: function (e) {
    									return "{{ optional($last_in_progress_review)->governance_meter() ?? 0 }}%"
    								}
    							}
    						},
    						track: {
    							background: KTUtil.getCssVariableValue("--bs-gray-300"),
    							strokeWidth: "100%"
    						}
    					}
    				},
    				colors: ['#44215F'],
    				stroke: {lineCap: "round"}
    			};
    			new ApexCharts(e, o).render()
    		}
    	}))
    </script>
    @endif
    @endpush
</x-panel>
