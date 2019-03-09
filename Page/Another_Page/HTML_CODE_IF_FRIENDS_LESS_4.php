<div class="friends_v2">								<!--	ЭТО ЕСЛИ 1 - 3  ДРУГА -->
				<div class="friends_link">
					<a id="friends_link" href="..\Friends\FAUS.php">Friends</a>
				</div>
				<div class="friends_block_v2">
					<table>
						<tr>
						<?php
							for ($i = 0; $i < $count; $i++)
							{ 
							$person = $Friends->fetch_assoc();
							$img_main_path = Get_Path_User_Avatar_by_id($person['id_Friend'], $person['img']);
							$img = "..\..\\".$img_main_path;
							?>
							<td>
								<div>
									<img src=<?=$img?>  class="ava" alt="">
								</div>
								<a href="Another_Page.php?id=<?=$person['id_Friend']?>&login=<?=$person['Login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>" class="name"><?=$person['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
					</table>
				</div>
			</div>