 <!-- The Modal Edit-->
 <div class="modal fade" id="EditModal">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <p class="modal-title" style="font-size: 30px;">EDIT </p>
                 <!-- <button type="button" class="close" data-dismiss="modal">x</button> -->
             </div>

             <!-- Modal body -->

             <div class="modal-body" id="EDIT">

             </div>
             <div class="row">
                 <div class="col">
                     <p style="margin-left: 40px;"><b>NOTE : </b><span style="color:red">*</span></p>
                 </div>
                 <div class="col">
                     <p style="float: right; margin-right: 40px; width: 60%;"><b>Admin : </b><input type="text" id="admin" style='width: 150px; height: 25px;' value="<?php echo $this->session->userdata("Admin_name") . " " . $this->session->userdata("Admin_lastname"); ?>" disabled></p>

                 </div>
             </div>
             <div class="row">
                 <div class="col">
                     <p style="text-align: center;"><textarea rows="8" cols="80" id="edit_note"></textarea></p>
                 </div>
             </div>
             <span id="alert" style="margin-left: 50px;"></span>
             <!-- Modal footer -->
             <div class="modal-footer" id="modal_footer">

             </div>

         </div>
     </div>
 </div>

 <!-- The Modal Confirm delete-->
 <div class="modal fade" id="modal_confirm_del">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <p class="modal-title" style="font-size: 30px;">DELETE</p>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
                 Do you want to delete it?
             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
                 <button type="button" class="button-cancel" " id=" cancel" data-dismiss="modal">Cancel</button>
                 <button type="button" class="button-confirm" id="confirm_delete" data-dismiss="modal">Confirm</button>
             </div>

         </div>
     </div>
 </div>

 <!-- The Modal show history-->
 <div class="modal fade" id="modal_show_edited">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <p class="modal-title" style="font-size: 30px;">HISTORY</p>
             </div>

             <!-- Modal body -->
             <div class="modal-body_edit" id="body_edited">
                 
             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
                 <button type="button" class="button-cancel" " id=" cancel" data-dismiss="modal">Close</button>
             </div>

         </div>
     </div>
 </div>

 <!-- The Modal show restore-->
 <div class="modal fade" id="modal_restore">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <p class="modal-title" style="font-size: 30px;">RESTORE</p>
             </div>

             <!-- Modal body -->
             <div class="modal-body" id="body_restore">

             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
                 <button type="button" class="button-cancel" data-dismiss="modal">Close</button>
             </div>

         </div>
     </div>
 </div>

 <!-- The Modal alert warning Edit-->
 <div class="modal fade" id="modal_warning1">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <p class="modal-title" style="font-size: 30px; color:red;">WARNING !!</p>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
               <a>Cannot edit your information.</a> 
             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
                 <button type="button" class="button-cancel" " id=" cancel" data-dismiss="modal">Close</button>
             </div>

         </div>
     </div>
 </div>

 <!-- The Modal alert warning Delete-->
 <div class="modal fade" id="modal_warning2">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <p class="modal-title" style="font-size: 30px; color:red;">WARNING !!</p>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
               <a>Cannot delete your information.</a> 
             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
                 <button type="button" class="button-cancel" " id=" cancel" data-dismiss="modal">Close</button>
             </div>

         </div>
     </div>
 </div>