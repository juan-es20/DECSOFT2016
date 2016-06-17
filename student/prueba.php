<?php 
include ('header.php')
 ?>
   <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
           <h3 class="text-center">Confirmar Inscripción</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
           <p class="text-center"></p>
        </div> 
    </div>   
     <div class="row">
        <div class="col-sm-6">
           <label class="control-label">Materia :</label>	
  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Descripción :</label>	

        </div>
         	
         	
      </div>
      <div class="row">
        <div class="col-sm-6">
            <div class="controls">
			  <label class="checkbox">
			    <?php echo $data['subject_name'];?>
			  </label>
			</div>
        </div> 
        <div class="col-sm-6">
            <div class="controls">
			    <label class="checkbox">
				   <?php echo $data['subject_description'];?>
			     </label>
		    </div>
        </div> 
    </div> 
     <div class="row">
        <div class="col-sm-6">
             <div class="form-actions">
			   <a class="btn btn-primary btn-sm" href="javascript:history.back()">Back</a>
			 </div>
        </div>
        <div class="col-sm-6">
             <div class="controls">
			    <label class="checkbox">
					<?php 
					  echo '<a class="btn btn-sm btn-primary" href="register_to_subject.php?subject_id='.$subject_id.'&confirm=1">Confirmar Inscripción</a>';
					?>
			     </label>
			</div>
        </div>
     </div>

  </div>  

        <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/scripts.js"></script>
        
    </body>

</html>