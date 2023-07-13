<?
  include "../../lib/seto.php";
  
  $letter = getNewsLetterInfo($sidx);
  
  $head = $letter['s_head'];
  
  $title_box = explode("|",$letter['s_title']);
  $title1 = $title_box[0];
  $title2 = $title_box[1];
  
  $cont_box = explode("|",$letter['s_cont']);
  $cont1 = $cont_box[0];
  $cont2 = $cont_box[1];
  
  $date_box = explode("-",$letter['s_wdate']);
  $year = $date_box[0];
  $mainimg = $img_path.$letter['s_mainimg'];
  $img1 = $img_path.$letter['s_img1'];
  // $img2 = $img_path.$letter['s_img2'];
  
?>
<div id='temp1' border='1' style='width:100%;padding:20px;background:#000'>      
<table border='0' cellpadding='0' cellspacing='0' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; min-height:100%; min-width:800px; padding:5px; width:800px'>
	<tbody>
		<tr>
			<td id='builder_box' style='min-width:800px; vertical-align:top'>
			<table border='0' cellpadding='0' cellspacing='0' id='logoyn' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; display:block; padding-bottom:15px; padding-left:15px; padding-right:15px; padding-top:15px; width:100%'>
				<tbody>
					<tr>
						<td style='width:770px'>
						<table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
							<tbody>
								<tr>
									<td style='text-align:left'><a builder-name='upd_img' href='https://setoworks.cafe24.com/img/seto_logo.png' style='display:inline-block;vertical-align:middle;' target='_new'><img alt='' border='0' name='upd_img' src='https://directsend.co.kr/upload_images/logo_64ae67c05e8e2setoworks039228' style='display:inline-block; max-width:100%; vertical-align:middle' width='165' /> </a></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>

			<table border='0' cellpadding='0' cellspacing='0' style='display:block; padding-top:5px; width:100%'>
				<tbody>
					<tr>
						<td style='width:800px'>
						<table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
							<tbody>
								<tr>
									<td name='border-type' style='border-color:#dddddd; border-top-style:solid; border-top-width:2px; font-size:1px; line-height:1px'></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>

			<table border='0' cellpadding='0' cellspacing='0' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; display:block; padding-left:15px; padding-right:15px; width:100%'>
				<tbody>
					<tr>
						<td style='width:770px'>
						<table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
							<tbody>
								<tr>
									<td style='text-align:center'>
									<p name='text_box' style='color:#fff; font-family:Helvetica,sans-serif; font-size:24px; font-weight:bold; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$head?></p>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>

			<table border='0' cellpadding='0' cellspacing='0' style='display:block; padding-top:5px; width:100%'>
				<tbody>
					<tr>
						<td style='width:800px'>
						<table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
							<tbody>
								<tr>
									<td name='border-type' style='border-color:#dddddd; border-top-style:solid; border-top-width:2px; font-size:1px; line-height:1px'></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>

			<table border='0' cellpadding='0' cellspacing='0' style='display:block; padding-top:5px; width:100%'>
				<tbody>
					<tr>
						<td style='width:800px'>
						<table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
							<tbody>
								<tr>
									<td style='text-align:center'>
                      <img alt='' border='0' name='upd_img' src='https://setoworks.cafe24.com/img/nsletter/<?=$year?>/<?=$mainimg?>' style='display:inline-block; max-width:100%; vertical-align:middle' width='800' /> 
                  </td>
								</tr>
								<tr>
									<td style='padding-left:15px; padding-right:15px; width:100%;text-align:center; padding-top:10px;'>
									<p name='text_box' style='color:#fff; font-family:Helvetica,sans-serif; font-size:45px; font-weight:bold; line-height:1.4; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$title1?></p>
									</td>
								</tr>
								<tr>
									<td style='padding-left:15px; padding-right:15px; width:100%;text-align:center;'>
									<p name='text_box' style='color:#fff; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; line-height:1.4; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$cont1?></p>
									</td>
								</tr>
                
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
			<table border='0' cellpadding='0' cellspacing='0' id='btnyn' style='display:block; padding-bottom:15px; padding-top:25px; width:100%'>
				<tbody>
					<tr>
						<td style='width:800px'>
						<table border='0' cellpadding='0' cellspacing='0' style='border:0px; table-layout:fixed; width:100%'>
							<tbody>
								<tr>
									<td style='text-align:center; width:800px'>
									<table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate; display:inline-block; vertical-align:middle'>
										<tbody>
											<tr>
												<td name='button_box' style='-webkit-box-sizing:border-box; background-color:#ffffff; border-color:#ffffff; border-radius:100px; border-style:solid; border-width:1px; box-sizing:border-box; padding-bottom:15px; padding-left:15px; padding-right:15px; padding-top:15px; text-align:center; width:240px; word-break:break-all'>
                          <a href='https://setoworks.cafe24.com' style='text-decoration:none;' target='_new'>
                            <font style='color:#000; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; text-align:center'>세토웍스 바로가기 </font> 
                          </a>
                        </td>
											</tr>
										</tbody>
									</table>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
      

			<table border='0' cellpadding='0' cellspacing='0' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; display:block; padding-bottom:10px; padding-left:15px; padding-right:15px; padding-top:15px; width:100%'>
				<tbody>
					<tr>
						<td style='width:770px'>
						<table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
							<tbody>
								<tr>
									<td style='text-align:center; width:50%'>
                    <img alt='' border='0' name='upd_img' src='https://setoworks.cafe24.com/img/nsletter/<?=$year?>/<?=$img1?>' style='display:inline-block; max-width:100%; vertical-align:middle' width='385' />
                  </td>
									<td style='padding-left:15px; padding-right:15px; width:50%'>
                  <p name='text_box' style='color:#fff; font-family:Helvetica,sans-serif; font-size:25px; font-weight:bold; line-height:1.4; margin-bottom:10px; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$title2?></p>
									<p name='text_box' style='color:#fff; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; line-height:1.4; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$cont2?></p>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>

			<table border='0' cellpadding='0' cellspacing='0' id='btnyn' style='display:block; padding-bottom:15px; padding-top:15px; width:100%'>
				<tbody>
					<tr>
						<td style='width:800px'>
						<table border='0' cellpadding='0' cellspacing='0' style='border:0px; table-layout:fixed; width:100%'>
							<tbody>
								<tr>
									<td style='text-align:center; width:800px'>
									<table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate; display:inline-block; vertical-align:middle'>
										<tbody>
											<tr>
												<td name='button_box' style='-webkit-box-sizing:border-box; background-color:#ffffff; border-color:#ffffff; border-radius:100px; border-style:solid; border-width:1px; box-sizing:border-box; padding-bottom:15px; padding-left:15px; padding-right:15px; padding-top:15px; text-align:center; width:240px; word-break:break-all'><a href='https://setoworks.cafe24.com' style='text-decoration:none;' target='_new'><font style='color:#000; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; text-align:center'>세토웍스 바로가기 </font> </a></td>
											</tr>
										</tbody>
									</table>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>

      </td>
		</tr>
	</tbody>
</table>
</div>