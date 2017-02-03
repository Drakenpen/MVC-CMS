    <?php foreach ($events as $event) { ?>
		<div class='banner' style='background-image:url({{$event['large_banner_url']}})'>	
			<h1 class='title'>{{$event['title']}}</h1>
		</div>  
	<?php } ?> 
                
    <?php foreach ($activities as $activity) { ?>
	<div>       
		<form method="POST" action="select_action.php" onsubmit="return confirm('Weet je het zeker?');">
            @if ($activity['ingeschreven'] == 0)
            <div class='img' style='background-image:url({{$activity['banner_url']}}); border-style:solid; border-width:medium; border-color:red;'> 
            @elseif ($activity['ingeschreven'] > 0)
            <div class='img' style='background-image:url({{$activity['banner_url']}}); border-style:solid; border-width:medium; border-color:green;'>
            @else
            <div class='img' style='background-image:url({{$activity['banner_url']}}); border-style:solid; border-width:medium; border-color:yellow;'>
            @endif
			    <div class='img2'>
				    <p class='data_info'>{{$activity['ingeschreven']}}</p>
				    <p class='data_info'>{{$activity['title']}}</p> 
				    <p class='data_info'>{{$activity['description']}}</p>
			    </div>
                
                <input type="hidden" name="activity_id" value="{{ $activity['id'] }}" >
                <input type="hidden" name="member_id" value="{{ $userid }}" >
                
		    	<input type="submit" name="submit" id="submit" value="Select" class="btn btn-info pull-right">
		    </div>
	    </form>	
    </div>      
	<?php } ?>