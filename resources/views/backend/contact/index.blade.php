@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content">
     	<div class="box box-primary">
     		
     		
     			<div class="box-header">
					<h3 class="about_title">
	                  	{{ trans('labels.contact_us') }}

	                   <div class="tools slider_edit">
	                      <a href="{{ route('contact.edit',1) }}">
	                          {{trans('labels.edit')}}
	                      </a>
	                    </div>

	                </h3>
				</div> <!-- end of box header -->
				<div class="box-body table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>{{ trans('labels.address') }}</th>
								<th>{{ trans('labels.phone_numbers') }}</th>
								<th>{{ trans('labels.email_addresses') }}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $contact->address }}</td>
								<td>
									<p>{{ $contact->phone }}</p>
									<p>{{ $contact->phone2 }}</p>
									<p>{{ $contact->phone3 }}</p>
									<p>{{ $contact->phone4 }}</p>
								</td>
								<td>
									<p>{{ $contact->email }}</p>
									<p>{{ $contact->email2 }}</p>
								</td>
							</tr>
						</tbody>
					</table>
		
				</div> <!-- end of box-body -->
     		

     	</div><!-- end of box-container -->
	</section>

@include('backend.includes.message')	
@endsection

@section('style')
  <style>

  		h3.about_title{
		    padding: 10px;
		    border-right: 2px solid #3c8dbc;
  		}
  		h3.about_title a{
	        font-size: 13px;
	    }
	    div.slider_edit{
	        display: inline;
	        float: left;
	        margin-left: 10px;
	     }
	    div.box-body{
	    	text-align: center;
	    }
	    div.contact_details h4{
	    	padding-bottom: 10px;
	    }
	    table th{
	    	text-align: center;
	    }
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection

