 <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.numeric.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.numeric.min.js');?>"></script>
<script type="text/javascript">
		<?php if ($this->session->flashdata('notification')): ?>
			alert('<?php echo $this->session->flashdata("notification"); ?>');
		<?php endif; ?>
</script>

<script>
   $(document).ready(function () {
  		//called when key is pressed in textbox
  		$(".num_only").keypress(function (e) {
     		//if the letter is not digit then display error and don't type anything
     		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        		//display error message
        
               return false;
    		}
   		});
	});
</script>

<script>
   $(document).ready(function() {
    $(".txt_only").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110,189,190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.keyCode >= 47 && e.keyCode <= 57) || (e.keyCode > 96 && e.keyCode > 123)) {
            e.preventDefault();
        }
    });
});
</script>
</body>
</html>