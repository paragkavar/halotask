/* Created by : Sawal Lubis */

$(document).ready(function() {
	$('#input-group').mask('9');
	$('#input-group').focus(function(){
		action_for_other_assetcode(false);
		$('#span-wait-item').show();
		$('#span-item').hide();
		$.ajax({
			url: '/request/showgroupitem/' + $('#input-group').val(),
			type: 'GET',
	        dataType:'json',
			success:function(result)
			{
				$('#span-item').show();
				$('#span-item').html(result.select);
				$('#span-wait-item').hide();
				
				bind_select_group();									
			}
		})	
	});
	
	$('#input-sector').mask('99');
	$('#input-sector').focus(function(){
		$('#span-wait-item').show();
		$('#span-item').hide();
		$.ajax({
			url: '/request/showsectoritem/' 
					+ $('#input-group').val() + '/' + $('#input-sector').val(),
			type: 'GET',
	        dataType:'json',
			success:function(result)
			{
				$('#span-item').show();
				$('#span-item').html(result.select);
				$('#span-wait-item').hide();
				
				bind_select_sector();									
			}
		});
    	return false;					
	});

	$('#input-cluster').mask('99');
	$('#input-cluster').focus(function(){
		$('#span-wait-item').show();
		$('#span-item').hide();
		$.ajax({
			url: '/request/showclusteritem/' +
					 $('#input-group').val() + '/' + 
					 $('#input-sector').val() + '/' + 
					 $('#input-cluster').val(),
			type: 'GET',
	        dataType:'json',
			success:function(result)
			{
				$('#span-item').show();
				$('#span-item').html(result.select);
				$('#span-wait-item').hide();
				
				bind_select_cluster();								
			}
		})	
    	return false;					
	});

	$('#input-subcluster').mask('99');
	$('#input-subcluster').focus(function(){
		$('#span-wait-item').show();
		$('#span-item').hide();
		$.ajax({
			url: '/request/showsubclusteritem/' + 
					 $('#input-group').val() + '/' + 
					 $('#input-sector').val() + '/' + 
					 $('#input-cluster').val() + '/' + 
					 $('#input-subcluster').val(),
			type: 'GET',
	        dataType:'json',
			success:function(result)
			{
				$('#span-item').show();
				$('#span-item').html(result.select);
				$('#span-wait-item').hide();
				
				bind_select_subcluster();								
			}
		})	
    	return false;					
	});

	$('#input-subsubcluster').mask('999');		
	$('#input-subsubcluster').focus(function(){
		$('#span-wait-item').show();
		$('#span-item').hide();  						
		$.ajax({
			url: '/request/showsubsubclusteritem/' + 
					 $('#input-group').val() + '/' + 
					 $('#input-sector').val() + '/' + 
					 $('#input-cluster').val() + '/' + 			
					 $('#input-subcluster').val(),
			type: 'GET',
	        dataType:'json',
			success:function(result)
			{
				$('#span-item').show();
				$('#span-item').html(result.select);
				$('#span-wait-item').hide();
				
				bind_select_subsubcluster();								
			}
		})	
    	return false;					
	});
	$('#input-subsubcluster').bind('keypress', function(e) {
		if(e.keyCode==13){
			var item_code =  $('#input-group').val() + '' + 
							 $('#input-sector').val() + '' + 
							 $('#input-cluster').val() + '' + 			
							 $('#input-subcluster').val() + '' + 
							 $('#input-subsubcluster').val();
							 			
			var rs = $('#input-subsubcluster').val();
			
			if(rs != 999){
				action_for_other_assetcode(false);
				
				$('#span-item').hide();
				$('#span-wait-item').show();
				$.ajax({
					url: '/request/infosubsubcluster/' + 
							item_code,
					type: 'GET',
			        dataType:'json',
					success:function(result)
					{
						$('#asset_name').html(result.asset_name);
						$('#asset_measurement').html(result.asset_mr);
						$('#span-wait-item').hide();
						$('#first_type_specification').focus();								
					}
				})
			}else{
				action_for_other_assetcode(true);	
			}
		}
	});

	$('#input-reseter').click(function(){
		$('#span-wait-item').hide()
		$('#span-item').hide();
		$('#input-group').val(''); 
		$('#input-sector').val('');
		$('#input-cluster').val(''); 			
		$('#input-subcluster').val('');
		$('#input-subsubcluster').val('');	
		action_for_other_assetcode(false);	
	});
});

var numberItem = 0;

//Set action when select-group was selected
function bind_select_group(){
	$('#select-group').change(function(){
		$('#input-group').val($('#select-group').val());
		$('#input-sector').focus();
		$('#input-cluster').val('');
		$('#input-subcluster').val('');
		$('#input-subsubcluster').val('');
	});		
}

//Set action when select-sector was selected
function bind_select_sector(){
	$('#select-sector').change(function(){
		$('#input-sector').val($('#select-sector').val());
		if($('#select-sector').val() != 99){
			action_for_other_assetcode(false);
			$('#input-cluster').focus();				
		}else{
			action_for_other_assetcode(true);
		}
		$('#input-cluster').val('');
		$('#input-subcluster').val('');
		$('#input-subsubcluster').val('');
	});
}

//Set action when select-cluster was selected
function bind_select_cluster(){
	$('#select-cluster').change(function(){
		$('#input-cluster').val($('#select-cluster').val());
		if($('#select-cluster').val() != 99){
			action_for_other_assetcode(false);
			$('#input-subcluster').focus();		
		}else{
			action_for_other_assetcode(true);
		}
		$('#input-subcluster').val('');
		$('#input-subsubcluster').val('');
	});		
}

//Set action when select-subcluster was selected
function bind_select_subcluster(){
	$('#select-subcluster').change(function(){
		$('#input-subcluster').val($('#select-subcluster').val());
		if($('#select-subcluster').val() != 99){
			action_for_other_assetcode(false);
			$('#input-subsubcluster').focus();		
		}else{
			action_for_other_assetcode(true);
		}
		$('#input-subsubcluster').val('');	
	});		
}

//Set action when select-subsubcluster was selected
function bind_select_subsubcluster(){
	$('#select-subsubcluster').change(function(){
		var item_code = '' + $('#select-subsubcluster').val() + '';
		var length = item_code.length;
		var rs = item_code.substr(length-3, length);
		
		$('#input-subsubcluster').val(rs);
		
		if(rs != 999){
			action_for_other_assetcode(false);
			
			$('#span-item').hide();
			$('#span-wait-item').show();
			$.ajax({
				url: '/request/infosubsubcluster/' + 
						$('#select-subsubcluster').val(),
				type: 'GET',
		        dataType:'json',
				success:function(result)
				{
					$('#asset_name').html(result.asset_name);
					$('#asset_measurement').html(result.asset_mr);
					$('#span-wait-item').hide();
					$('#first_type_specification').focus();								
				}
			})
		}else{
			action_for_other_assetcode(true);	
		}
	});		
}

//If value for some value is 99 so run this function
function action_for_other_assetcode(action){
	if(action){
		$('#span-asset-name').hide();
		$('#span-asset-measurement').hide();
		
		$('#span-asset-name-input').show();
		$('#asset-name-input').val('');	

		$('#span-asset-measurement-input').show();
		$('#asset-measurement-input').val('');
							
		$('#asset-name-input').focus();			
	}else{
		$('#span-asset-name-input').hide();
		$('#span-asset-measurement-input').hide();
		
		$('#asset-name-input').val('');		
		$('#asset-measurement-input').val('');		
		
		$('#span-asset-name').show();
		$('#span-asset-measurement').show();
		
		$('#asset_name').html('-');
		$('#asset_measurement').html('-');						
	}
}
	