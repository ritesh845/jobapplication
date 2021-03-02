<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job Application Form') }}
        </h2>
    </x-slot>

	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Update Job Application Form
							<a href="{{route('jobapplication.index')}}" class="btn btn-sm btn-primary pull-right"> Back</a>
					</div>
					<div class="card-body">
						<form action="{{route('jobapplication.update',$job->jobSeekerId)}}" method="post" autocomplete="off">
							@csrf
							@method('patch')
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Basic Details</h4></div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="name">Name</label>
									<input type="text" name="name" value="{{old('name') ?? $job->name}}" class="form-control" placeholder="Enter your name" required="">
									@error('name')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="email">Email</label>
									<input type="email" name="email" value="{{old('email') ?? $job->email}}" class="form-control" placeholder="Enter your email" required="">
									@error('email')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="contact">Contact</label>
									<input type="text" name="contact" value="{{old('contact') ?? $job->contact}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('contact')}}" placeholder="Enter your contact number" required="">
									@error('contact')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="gender">Gender</label>
									<select name="gender" class="form-control" required="required">
										<option value="">Select Gender</option>
										@foreach(GENDER as $key => $gender)
											<option value="{{$key}}" {{(old('gender') ?? $job->gender) == $key ? 'selected' : '' }}> {{$gender}}</option>
										@endforeach
									</select>
									@error('gender')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
						
								<div class="col-md-4 form-group">
									<label for="address">Address</label>
									<input type="text" name="address" value="{{old('address') ?? $job->address}}" class="form-control" placeholder="Enter your address" required="required">
								</div>
								<div class="col-md-4 form-group" >
									<label for="city_id">Location</label>
									<select name="city_id" class="form-control" required="required">
										<option value="">Select Location</option>
										@foreach(CITY as $c_key => $city)
											<option value="{{$c_key}}" {{(old('city_id') ?? $job->city_id) == $c_key  ? 'selected' : '' }}>{{$city}}</option>
										@endforeach
									</select>
									@error('city_id')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="current_ctc">Current CTC</label>
									<input type="text" name="current_ctc" value="{{old('current_ctc') ?? $job->current_ctc}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter your current ctc">
									@error('current_ctc')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="expected_ctc">Expected CTC</label>
									<input type="text" name="expected_ctc" value="{{old('expected_ctc') ?? $job->expected_ctc}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter your expected ctc">
									@error('expected_ctc')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="notice_period">Notice Period <span class="text-muted">(In Days)</span></label>
									<input type="text" name="notice_period" value="{{old('notice_period') ?? $job->notice_period}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter your notice period in days">
									@error('notice_period')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Education Details</h4></div>
							</div>
							
							<div class="row">
								<div class="col-md-12 form-group">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Eduation Name</th>
												<th>Board University</th>
												<th>Year</th>
												<th>CGPA/Percentage</th>
											</tr>
										</thead>
										<tbody>
											@foreach($job->educations as $education )
												<tr>
													<td>
														<input type="text"  readonly="readonly" name="eduName[]" value="{{$education->educName}}" class="form-control">
													</td>
													<td>
														<input type="text" name="board[]" value="{{$education->board}}" class="form-control" placeholder="Enter board/university name">
													</td>
													<td>
														<input type="text"  name="year[]" value="{{$education->year}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
													</td>
													<td>
														<input type="text"  name="percent[]" value="{{$education->percent}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9|.]/g, '').replace(/(\..*)\./g, '$1');" data>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Education Details</h4></div>
							</div>

							<div class="row">
								<div class="col-md-12 form-group">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Company Name</th>
												<th>Designation</th>
												<th>From</th>
												<th>To</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="expBody">
											@foreach($job->experiences as $exKey =>  $experience)
											<tr id="row{{$exKey}}">
												<td>
													<input type="text" name="company[]" value="{{$experience->company}}" class="form-control" placeholder="Enter company name">
												</td>
												<td>
													<input type="text" name="designation[]" value="{{$experience->designation}}" class="form-control" placeholder="Enter designation">
												</td>
												<td>
													<input type="text" name="from[]" value="{{date('Y-m-d',strtotime($experience->from))}}" class="form-control datepicker" placeholder="Enter from date" data-date-format="yyyy-mm-dd">
												</td>
												<td>
													<input type="text" name="to[]" value="{{date('Y-m-d',strtotime($experience->to))}}" class="form-control datepicker" placeholder="Enter to date" data-date-format="yyyy-mm-dd">
												</td>
												<td>
													@if($exKey != 0)
														<td><a href="javascript:void(0)" class="btn btn-sm btn-danger removeBtn" id="{{$exKey}}"><i class="fa fa-minus"></i></a></td>
													@else
													<a href="javascript:void(0)" class="btn btn-sm btn-success" id="addMore"><i class="fa fa-plus"></i></a>
													@endif
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Language Known</h4></div>
							</div>
							{{-- @foreach( as $edLanguage ) --}}
								@foreach(Languages as $l_key => $language)

								{{-- @if() --}}
									<div class="row">
										<div class="col-md-3 form-group">
											<input type="checkbox" name="langName[]" value="{{$l_key}}" class="checkBoxChange" id="{{$l_key}}" {{count(collect($job->languages)->where('langName',$l_key)) !=0 ? 'checked="checked"' : '' }}> {{$language}}
										</div>
										@foreach(LanguageOptions as $lq_key => $languageOption)
											<div class="col-md-2 form-group">
												<input type="checkbox" name="{{$l_key}}[]" value="{{$lq_key}}" class="answer_{{$l_key}}" 

												@forelse (collect($job->languages)->where('langName',$l_key) as $option)
												   {{$option->answer == $lq_key ? 'checked="checked"' : '' }}
												@empty
												 disabled="disabled"
												@endforelse > {{$languageOption}}
											</div>							
										@endforeach
									</div>
								@endforeach
							{{-- @endforeach --}}
							<hr>
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Technical Known</h4></div>
							</div>
							@foreach(Technical as $t_key => $technical)
								<div class="row">
									<div class="col-md-3 form-group">
										<input type="checkbox" name="techName[]" value="{{$t_key}}" class="checkBoxChange"  {{count(collect($job->technicals)->where('techName',$t_key)) !=0 ? 'checked="checked"' : '' }}> {{$technical}}
									</div>
									@foreach(TechnicalOption as $tq_key => $technicalOption)
									<div class="col-md-2 form-group">
										<input type="radio" name="{{$t_key}}" value="{{$tq_key}}" class="answer_{{$t_key}}" 
										@forelse (collect($job->technicals)->where('techName',$t_key) as $options)
										   {{$options->answer == $tq_key ? 'checked="checked"' : '' }}
										@empty
										 disabled="disabled"
										@endforelse > {{$technicalOption}}
									</div>							
									@endforeach
								</div>
							@endforeach

							<div class="row">
								<div class="col-md-12 form-group">
									<button type="submit" class="btn btn-sm btn-success">Update</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			
	      $(document).on('focus', '.datepicker', function () {
	          $(this).datepicker();
	      });

	        var row = "{{count($job->experiences)}}";
	        $('#addMore').on('click',function(e){
	            e.preventDefault();
	            var html = '<tr id="row'+row+'"><td><input type="text" name="company[]" value="" class="form-control" placeholder="Enter company name"></td><td><input type="text" name="designation[]" value="" class="form-control" placeholder="Enter designation"></td><td><input type="text" name="from[]" value="" class="form-control datepicker" placeholder="Enter from date" data-date-format="yyyy-mm-dd"></td><td><input type="text" name="to[]" value="" class="form-control datepicker" placeholder="Enter to date" data-date-format="yyyy-mm-dd"></td><td><a href="javascript:void(0)" class="btn btn-sm btn-danger removeBtn" id="'+row+'"><i class="fa fa-minus"></i></a></td></tr>';
	            $('#expBody').append(html);
	            row++;
	        });

	        $(document).on('click','.removeBtn',function(e){
	            e.preventDefault();
	            var rowId = $(this).attr('id');
	            $('#row'+rowId).remove(); 
	        });


	        $('.checkBoxChange').on('change',function(e){
	        	e.preventDefault();
	        	var id = $(this).val();
				if ($(this).prop('checked')==true){ 
				    $('.answer_'+id).removeAttr('disabled');
				}else{
				    $('.answer_'+id).prop( "checked", false );
				    $('.answer_'+id).attr('disabled',true);

				}
	        });
	          @if($message = Session::get('success'))
	  		alert("{{$message}}");
	  @endif 
		})
	</script>
</x-app-layout>
