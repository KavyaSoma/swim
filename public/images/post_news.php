<?php
include('header.php');
include($_SESSION["user_type"].'_sidebar.php');
?>
 <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
 <link href="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript">
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>		
		
<!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- Breadcrumbs Starting -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="welcomeuser.php">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Breadcrumbs Ending -->
                    <h3 class="page-title"></h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN DASHBOARD STATS 1-->
                         <div class="portlet light ">
							<div class="portlet-body">
								    <ul class="nav nav-tabs"  id="myTab">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> News</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> Advertisement </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
										<?php
										if(isset($_POST['post-news'])){
										if(isset($_POST["Subject"])&&isset($_POST["Url"])&&isset($_POST["Message"]))
										{
										   $filename = $_FILES['file']['name'];
											  $filesize =  $_FILES['file']['size'];
											  $formats = array("jpg","png","gif","bmp"); // Set File format
											  $path = "images/";
													 $extensions = substr($name, strrpos($name, '.')+1);
											  if (in_array($extensions, $formats)) { 
													 $imgname = md5(uniqid().time()).".".$extensions;
													 $tm = $_FILES['file']['tmp_name'];
													 echo"<script>".$tm."</script>";
													  if (move_uploaded_file($tm, $path . $imgname)){
														echo $imgs=$path.$imgname;
														}
												 }
												 else{
													  echo"<script>alert('Please select only jpg/png/gif/bmp');</script>"; 
												}
												
											if($mysqli->query("INSERT into Advertisements(UserId,AdvertisementType,Subject,Url,Message,Status) values ('".$_SESSION['user_id']."','news','".$_POST['Subject']."','".$_POST['Url']."','".$_POST['Message']."','Pending')"))
											{
											$lastid=$mysqli->insert_id;
											  $s= $mysqli->query("INSERT into Images(ImagePath,ImageRefType,ReferenceId,CreatedDate) values ('$imgs','news','$lastid',now())");
											?><br>
											<div class="alert alert-success text-center alert-dismissable">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Request Sent Successfully.
</div>
											<?php
											}
											else
											{
											?>
											<div class="alert alert-danger text-center alert-dismissable">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error</strong> Unable to send Request.
</div>
											<?php
											}
											}
										}
										?>	
                                           <!--BEGIN FORM-->
									     	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                           <div class="form-body">

									                 <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="control-label col-md-3">Subject<span class="error"></span></label>
                                                                    <div class="col-md-4">
                            <input type="text" name="Subject" id="contact" class="form-control" value="<?php echo isset($_POST['Subject']) ? $_POST['Subject'] : '' ?>" required >
                                                                        <span class="error"> </span>
                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>
                                                        <!--/row-->
														  <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="control-label col-md-3">Url<span class="error"></span></label>
                                                                    <div class="col-md-4">
                            <input type="url" name="Url" id="club_name" class="form-control"  value="<?php echo isset($_POST['Url']) ? $_POST['Url'] : '' ?>" required >
                                                                        <span class="error"> </span>
                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>
                                                        <!--/row-->
														<div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="control-label col-md-3">Banner<span class="error"></span></label>
                                                                    <div class="col-md-4">
                             <input type="file" name="file">
                                                                        <span class="error"> </span>
                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>
                                                        <!--/row-->
                                                     
														
														  <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Message<span class="error"></span></label>
                                                                       <div class="col-md-6">
                                                    <textarea  name="Message" data-provide="markdown" rows="10" data-width="600" class="form-control">
													</textarea>
                                                   
                                                </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>   <!--/row-->
                                                     
														  <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                  
                                                                    <div align="center">
                                                                   <input type="submit" name="post-news" class="btn btn-primary"value="Submit">

                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>  <!--/row-->
                                               </div>
					                    </form>
										   <!--END FORM-->
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_2">
										
									<?php
									if(isset($_POST['post-ad'])){
										if(isset($_POST["Subject"])&&isset($_POST["Url"])&&isset($_POST["Message"]))
										{
											  $name = $_FILES['imagefile']['name'];
											  $size =  $_FILES['imagefile']['size'];
											  $file_formats = array("jpg", "png", "gif", "bmp"); // Set File format
											  $filepath = "images/";
													 $extension = substr($name, strrpos($name, '.')+1);
											  if (in_array($extension, $file_formats)) { 
													 $imagename = md5(uniqid().time()).".".$extension;
													 $tmp = $_FILES['imagefile']['tmp_name'];
													 echo"<script>".$tmp."</script>";
													  if (move_uploaded_file($tmp, $filepath . $imagename)){
														 $img=$filepath.$imagename;
														}
												 }
												 else{
													  echo"<script>alert('Please select only jpg/png/gif/bmp');</script>"; 
												}
										
											if($mysqli->query("INSERT into Advertisements(UserId,AdvertisementType,Subject,Url,Message,Status) values ('".$_SESSION['user_id']."','advertisement','".$_POST['Subject']."','".$_POST['Url']."','".$_POST['Message']."','Pending')"))
											{
											 $lastid=$mysqli->insert_id;
											  $stmt= $mysqli->query("INSERT into Images(ImagePath,ImageRefType,ReferenceId,CreatedDate) values ('$img','advertisement','$lastid',now())");
											?><br>
											<div class="alert alert-success text-center alert-dismissable">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Request Sent Successfully.
</div>
											<?php
											}
											else
											{
											?>
											<div class="alert alert-danger text-center alert-dismissable">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error</strong> Unable to send Request.
</div>
											<?php
											}
										}
									 }
										?>
										
										
                                            <!--BEGIN FORM-->
									     	<form name="post-ad" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                           <div class="form-body">

									                 <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="control-label col-md-3">Subject<span class="error"></span></label>
                                                                    <div class="col-md-4">
                            <input type="text" name="Subject" id="contact" class="form-control" value="<?php echo isset($_POST['Subject']) ? $_POST['Subject'] : '' ?>" required >
                                                                        <span class="error"> </span>
                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>
                                                        <!--/row-->
														  <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="control-label col-md-3">Url<span class="error"></span></label>
                                                                    <div class="col-md-4">
                            <input type="url" name="Url" id="club_name" class="form-control"  value="<?php echo isset($_POST['Url']) ? $_POST['Url'] : '' ?>" required >
                                                                        <span class="error"> </span>
                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>
                                                        <!--/row-->
														  <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="control-label col-md-3">Banner<span class="error"></span></label>
                                                                    <div class="col-md-4">
                             <input type="file" name="imagefile" id="fileToUpload">
                                                                        <span class="error"> </span>
                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>
                                                        <!--/row-->
												   <div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Message<span class="error"></span></label>
																   <div class="col-md-6">
												<textarea  name="Message" data-provide="markdown" rows="10" data-width="600" class="form-control">
												</textarea>
											   
                                                </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>   <!--/row-->
                                                     
														  <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-md-line-input">
                                                                  
                                                                    <div align="center">
                                                                   <input type="submit" name="post-ad" class="btn btn-primary"value="Submit">

                                                                    </div>
                                                                </div>
                                                            </div>  <!--/span-->
													 </div>  <!--/row-->
                                               </div>
					                    </form>
												
												 <!--END FORM-->
                                        </div>
                                
                              
                                    </div>
								</div>
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
                         
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
			    <script src="assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
  <script src="assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>

<?php
include('footer.php');
?>