<div id="response"></div>
<form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" id="register" >
<div class="panel panel-info">
	<div class="panel-heading" data-toggle="collapse" data-target="#one" style="font-size:150%;"><b>Fill your details</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="one">
		<div class="row form-group">
			<label for="univ_roll" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">University Roll No</label>
			<div class="col-sm-10">
				<input id="univ_roll" name="univ_roll" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="pass" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Password</label>
			<div class="col-sm-10">
				<input id="pass" name="pass" type="password" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="pass_re" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Re-type Password</label>
			<div class="col-sm-10">
				<input id="pass_re" data-match="#pass" data-match-error="Passwords don't match" type="password" class="form-control" required />
				<div class="help-block with-errors"></div>
			</div>
		</div>
		<div class="row form-group">
			<label for="dep" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Department</label>
			<div class="col-sm-10">
				<select required class="form-control" id="dep" name="dep">
					<option value="">--Select--</option>
					<option value="CSE">Computer Science and Engineering</option>
					<option value="IT">Information Technology</option>
					<option value="CE">Civil Engineering</option>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<label for="access_code" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Access code</label>
			<div class="col-sm-10">
				<input id="access_code" name="access_code" type="text" class="form-control" required />
			</div>
		</div>
		
		<div class="row form-group">
			<div class="col-sm-offset-5 col-sm-2">
			     <button type="submit" class="btn btn-warning col-sm-8 col-sm-offset-2">
					<span class="glyphicon glyphicon-floppy-disk"></span>
					<br class="hidden-lg hidden-sm hidden-xs">					
					<span class="hidden-sm">Get Token</span>
				 </button>
			</div>
		</div>
	</div>
</div>
</form>

<script>
    $(".ajaxsubmitform").validator();
    $(".ajaxsubmitform").on('submit',function(e) {
        var formid=$(this).attr('id');//get this form's id
        e.preventDefault(); // avoid to execute the actual submit of the form.
	    setTimeout(function(e){ //wait 50ms to allow validator to execute
            // var data1=$("#"+formid).serialize()+"&flag"+formid+"=Y";
	        // alert($("#"+formid).find('.has-error').length);//No of errors in the form
            if($("#"+formid).find('.has-error').length==0) 
            {
                var data= $("#"+formid).serialize();
                $('#response').ajaxReload("submit",formid,data);
            }
        }, 50);
    });
</script>