<div class="col-md-4">
	<div class="ert_enquiry_block">
		<h4>Make an enquiry</h4>
		<form id="enquiry_form" class="ert_enquiry_form" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="exampleInputEmail1">Full Name</label>
				<input type="text" class="form-control" name="name" required id="exampleInputEmail1"></div>
			<div class="form-group">
				<label for="exampleInputPassword1">Email Address</label>
				<input type="email" class="form-control" name="email" required id="exampleInputPassword1"></div>
			<div class="form-group">
				<label for="exampleInputPassword1">Contact Number</label>
				<input type="text" class="form-control" name="contact" required id="exampleInputPassword1"></div>
			<div class="form-group">
				<label for="exampleInputEmail1">Messages</label>
				<textarea class="form-control" name="message" required rows="4"></textarea>
			</div>
			<button type="submit" class="btn ert-btn btn-default pull-right">Submit</button>
		</form>
	</div>
</div>

@section ('pageScripts')
<script type="text/javascript">
	$(function() {
		$("#enquiry_form").on('submit', function(event) {
			event.preventDefault();
			var form = $(this);
			var formData = form.serialize();

			$.ajax({
			    url: "../inquiries/store",
			    type: 'POST',
			    data: formData,
			    success: function(res) {
			        // if (res.status === 1) {
						toastr.success('Your enquiry has been sent.');
						form[0].reset();
			             
			        // }
			    }
			}); 
		});
	});
</script>
@endsection