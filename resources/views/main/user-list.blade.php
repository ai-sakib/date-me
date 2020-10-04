@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users (Near 5 km)') }}</div>

                <div class="card-body">
                    <table class="table table-bordered table-stripped table-hover">
                    	<thead>
                    		<tr style="background-color: #17a2b8; color: white" class="text-center">
                    			<th>SL</th>
                    			<th>Name</th>
                    			<th>Image</th>
                    			<th>Distance</th>
                    			<th>Gender</th>
                    			<th>Age</th>
                    			<th>Like/Dislike</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@if(isset($users[0]->id))
                    			@foreach($users as $key => $user)
                    			@php
                    				$user_main = App\User::find($user->user_id);	
                    				$like = \App\Models\Like::where('from_user', Auth::id())->where('to_user',$user->user_id)->first();
                    			@endphp
                    				<tr class="text-center">
                    					<td>{{ $key + 1 }}</td>
                    					<td>{{ $user_main->name }}</td>
                    					<td style="padding: 3px">
                                            @if($user->photo != '' && file_exists(public_path('photos/'.$user->photo)))
                                                <img style="max-width: 70px; max-height: 70px" src="{{ asset('photos/') }}/{{ $user->photo }}">
                                            @else
                                                <img style="max-width: 70px; max-height: 70px" src="{{ asset('photos/no-image.png') }}">
                                            @endif               
                                        </td>
                    					<td>{{ number_format($user->distance, 2, '.', '') }} km</td>
                    					<td>{{ ($user->gender == 1 ? 'Male' : 'Female')}}</td>
                    					<td>{{ getAge($user->date_of_birth) }} y</td>
                    					<td>
                    						@if(isset($like->id))
                    						<a id="like-status-{{ $user->user_id }}" style="width: 100px" onclick="likeStatus('{{ $user->id }}','0')" class="btn btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;Dislike</a>
                    						@else
                    						<a id="like-status-{{ $user->user_id }}" style="width: 100px" onclick="likeStatus('{{ $user->user_id }}','1')" class="btn btn-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Like</a>
                    						@endif
                    					</td>
                    				</tr>
                    			@endforeach
                    		@endif
                    	</tbody>
                    </table>

                </div>
                <div class="card-footer">
                    <div class="text-center"><center>{{ $users->links() }}</center></div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script type="text/javascript">
	function likeStatus(user_id,status){
	    if(status == '1'){
	      var nextStatus = '0';
	      $('#like-status-'+user_id+'').removeClass('btn btn-success');
	      $('#like-status-'+user_id+'').addClass('btn btn-danger');
	      $('#like-status-'+user_id+'').attr('onclick','likeStatus('+user_id+','+nextStatus+')');
	      $('#like-status-'+user_id+'').html('<i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;Dislike');
	    }else{
	      var nextStatus = '1';
	      $('#like-status-'+user_id+'').removeClass('btn btn-danger');
	      $('#like-status-'+user_id+'').addClass('btn btn-success');
	      $('#like-status-'+user_id+'').attr('onclick','likeStatus('+user_id+','+nextStatus+')');
	      $('#like-status-'+user_id+'').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Like');
	    }
	    $.ajax({
		    url: '{{ url('like-status') }}/'+user_id+'&'+status,
		    type: 'GET',
		    dataType: 'json',
		  })
		  .done(function(response) {
		    if(response.success){
		    	if(response.match == 1){
		    		$.alert({
					    title:"Matched !",
					    icon: 'fa fa-smile-o',
					    content:"<hr>Now you can date with <strong class='text-primary'>"+response.date_partner+"</strong><hr>",
					    type:"green"
					 });
		    		// $.confirm({
        //                 icon: 'fa fa-smile-o',
        //                 theme: 'modern',
        //                 //closeIcon: true,
        //                 animation: 'scale',
        //                 type: 'blue',
        //             });
		    	}
		    }
		});
	}
</script>
