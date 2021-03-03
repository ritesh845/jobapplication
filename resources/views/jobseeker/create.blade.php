@extends('layouts.main')
@section('content')
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Submit Job Application Form</div>
					<div class="card-body">
						<form action="{{route('jobapplication.store')}}" method="post" autocomplete="off" id="example-form">
							@csrf

							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Basic Details</h4></div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group error-div">
									<label for="name" class="required">Name</label>
									<input type="text" name="name" value="{{old('name')}}" class="form-control required" placeholder="Enter your name">
									@error('name')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group  error-div">
									<label for="email" class="required">Email</label>
									<input type="email" name="email" value="{{old('email')}}" class="form-control required" placeholder="Enter your email">
									@error('email')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group error-div">
									<label for="contact" class="required">Contact</label>
									<input type="text" name="contact" value="{{old('contact')}}" class="form-control required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('contact')}}" placeholder="Enter your contact number">
									@error('contact')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group error-div">
									<label for="gender" class="required">Gender</label>
									<select name="gender" class="form-control required">
										<option value="">Select Gender</option>
										@foreach(GENDER as $key => $gender)
											<option value="{{$key}}" {{$key == old('gender') ? 'selected' : '' }}> {{$gender}}</option>
										@endforeach
									</select>
									@error('gender')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
						
								<div class="col-md-4 form-group error-div">
									<label for="address" class="required">Address</label>
									<input type="text" name="address" value="{{old('address')}}" class="form-control required" placeholder="Enter your address">
								</div>
								<div class="col-md-4 form-group error-div" >
									<label for="city_id" class="required">Location</label>
									<select name="city_id" class="form-control required">
										<option value="">Select Location</option>
										@foreach(CITY as $c_key => $city)
											<option value="{{$c_key}}" {{$c_key == old('city_id') ? 'selected' : '' }}>{{$city}}</option>
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
								<div class="col-md-4 form-group error-div">
									<label for="current_ctc" class="required">Current CTC</label>
									<input type="text" name="current_ctc" value="{{old('current_ctc')}}" class="form-control required"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter your current ctc">
									@error('current_ctc')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group error-div">
									<label for="expected_ctc" class="required">Expected CTC</label>
									<input type="text" name="expected_ctc" value="{{old('expected_ctc')}}" class="form-control required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter your expected ctc">
									@error('expected_ctc')
	                                    <span class="invalid-feedback d-block" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4 form-group error-div">
									<label for="notice_period" class="required">Notice Period <span class="text-muted">(In Days)</span></label>
									<input type="text" name="notice_period" value="{{old('notice_period')}}" class="form-control required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter your notice period in days">
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
											@foreach(EduMasT as $edu_key => $education )
												<tr>
													<td>
														<input type="text"  readonly="readonly" name="eduName[]" value="{{$edu_key}}" class="form-control">
													</td>
													<td>
														<input type="text" name="board[]" value="" class="form-control" placeholder="Enter board/university name">
													</td>
													<td>
														<input type="text"  name="year[]" value="" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
													</td>
													<td>
														<input type="text"  name="percent[]" value="" class="form-control"  oninput="this.value = this.value.replace(/[^0-9|.]/g, '').replace(/(\..*)\./g, '$1');" data>
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
												<th class="required">Company Name</th>
												<th class="required">Designation</th>
												<th class="required">From</th>
												<th class="required">To</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="expBody">
											<tr id="row0">
												<td class="error-di form-group">
													<input type="text" name="company[]" value="" class="form-control" placeholder="Enter company name"	>
												</td>
												<td  class="error-di form-group">
													<input type="text" name="designation[]" value="" class="form-control" placeholder="Enter designation">
												</td>
												<td  class="error-di form-group">
													<input type="text" name="from[]" value="" class="form-control datepicker" placeholder="Enter from date" data-date-format="yyyy-mm-dd">
												</td>
												<td  class="error-di form-group">
													<input type="text" name="to[]" value="" class="form-control datepicker" placeholder="Enter to date" data-date-format="yyyy-mm-dd">
												</td>
												<td  class="error-di form-group">
													<a href="javascript:void(0)" class="btn btn-sm btn-success" id="addMore"><i class="fa fa-plus"></i></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Language Known</h4></div>
							</div>
							@foreach(Languages as $l_key => $language)
								<div class="row">
									<div class="col-md-3 form-group">
										<input type="checkbox" name="langName[]" value="{{$l_key}}" class="checkBoxChange" id="{{$l_key}}"> {{$language}}
									</div>
									@foreach(LanguageOptions as $lq_key => $languageOption)
									<div class="col-md-2 form-group">
										<input type="checkbox" name="{{$l_key}}[]" value="{{$lq_key}}" class="answer_{{$l_key}}" disabled="disabled"> {{$languageOption}}
									</div>							
									@endforeach
								</div>
							@endforeach
							<hr>
							<div class="row">
								<div class="col-md-12 form-group"><h4 class="font-weight-bold">Technical Known</h4></div>
							</div>
							@foreach(Technical as $t_key => $technical)
								<div class="row">
									<div class="col-md-3 form-group">
										<input type="checkbox" name="techName[]" value="{{$t_key}}" class="checkBoxChange"> {{$technical}}
									</div>
									@foreach(TechnicalOption as $tq_key => $technicalOption)
									<div class="col-md-2 form-group">
										<input type="radio" name="{{$t_key}}" value="{{$tq_key}}" class="answer_{{$t_key}}" disabled="disabled"> {{$technicalOption}}
									</div>							
									@endforeach
								</div>
							@endforeach

							<div class="row">
								<div class="col-md-12 form-group">
									<button type="submit" class="btn btn-sm btn-success">Submit</button>
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
	      $('label.required, th.required').append('<strong class="text-danger"> *</strong>')

	        var row = 1;
	        $('#addMore').on('click',function(e){
	            e.preventDefault();
	            var html = '<tr id="row'+row+'"><td class="error-di form-group"><input type="text" name="company[]" value="" class="form-control" placeholder="Enter company name" </td><td class="error-di form-group"><input type="text" name="designation[]" value="" class="form-control" placeholder="Enter designation"></td><td class="error-di form-group"><input type="text" name="from[]" value="" class="form-control datepicker" placeholder="Enter from date" data-date-format="yyyy-mm-dd"></td><td class="error-di form-group"><input type="text" name="to[]" value="" class="form-control datepicker" placeholder="Enter to date" data-date-format="yyyy-mm-dd"></td><td><a href="javascript:void(0)" class="btn btn-sm btn-danger removeBtn" id="'+row+'"><i class="fa fa-minus"></i></a></td></tr>';
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


	        var form = $("#example-form");

	        form.validate({   
	            rules: {    
	                'contact' :{
	                    minlength:10,
	                    maxlength:10,

	                },
	                'company[]':{
	                	experience:true,
	                },
	                'designation[]':{
						experience:true,
					},
					'from[]':{
						experience:true,
					},
					'to[]':{
						experience:true,
					}
	            },
	            errorElement: "em",
	            errorPlacement: function errorPlacement(error, element) { 
	                element.after(error);
	                error.addClass( "help-block" );

	             },
	            highlight: function ( element, errorClass, validClass ) {
	                $( element ).parents( ".error-div" ).addClass( "has-error" ).removeClass( "has-success" );
	            },
	            unhighlight: function (element, errorClass, validClass) {
	                $( element ).parents( ".error-div" ).addClass( "has-success" ).removeClass( "has-error" );
	            },
	        });                         

        	$.validator.addMethod("experience", function (value, element) {
		        var flag = true;
		       
		      	$("[name^=company], [name^=designation],[name^=from],[name^=to]").each(function (i, j) {

		      		$(this).parent('.error-di').find('em.error').remove();
		      		$(this).parent('.error-di').removeClass("has-error");
		            if ($.trim($(this).val()) == '') {
		                flag = false;        
		                 
		               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
		               	$(this).parent('.error-di').append('<em class="error help-block">This field is required.</em>');             
		            }
		            else{
		            	flag = true;
		               
		            	$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );
		            }
		      		
		        });
				$("[name^=to]").each(function (i, j) {
	                var start_date = [];
	                var end_date = [];


	                $('input[name="from[]"]').each(function(i,v){
	                	if ($.trim($(this).val()) != '') {
	                		start_date.push($(this).val());

	                	}
	                });

	                $('input[name="to[]"]').each(function(i,v){
	                	if ($.trim($(this).val()) != '') {
	                		end_date.push($(this).val());

	                	}
	                });
	                if(start_date.length !=0 && end_date.length !=0){
	                	
	                	if(start_date[i] < end_date[i]){
							flag = true;		             
		            		$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );                   	

	                	}else{
	                		flag = false;
	                		$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
		               		$(this).parent('.error-di').append('<em class="error help-block">To date is greater than to From date.</em>');  
	                	}

	                }
			    	

			     });


		        return flag;

		    }, "");


		    

		})
	</script>
@endsection
