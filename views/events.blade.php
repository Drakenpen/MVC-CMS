@extends('layout')

@section('content')

	<h1>Evenementen</h1>

	@foreach ( $events as $event ) 
	<div>
		<a href="event_activities.php?id={{$event['id']}}">
		    <div class='img' style='background-image:url({{$event['small_banner_url']}})'>
				<div class='img2'>
				    <p class='data_info'>{{$event['title']}}</p> 
				    <p class='data_info'>{{$event['start_date']}}</p>
				   	<p class='data_info'>{{$event['end_date']}}</p> 
			    </div>
		    </div>
	    </a>
    </div>	
	@endforeach
	

@endsection