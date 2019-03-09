<div class="friends_v1">								<!--	ЭТО ЕСЛИ 4 И БОЛЕЕ ДРУЗЕЙ  -->
				<div class="friends_link">
					<a id="friends_link" href="..\Friends\MFS.php">Friends</a>
				</div>
				<div class="friends_block_v1">
					<table>
						<tr>
							<?php
							for ($i = 0; $i < 3; $i++)
							{ 
							$person = $Friends->fetch_assoc();
							$img_main_path = Get_Path_User_Avatar_by_id($person['id_Friend'], $person['img']);
							$img = "..\\".$img_main_path;
							?>
							<td>
								<div>
									<img src=<?=$img?> class = "ava" alt="">
								</div>
								<a href="..\Another_Page\Another_Page.php?id=<?=$person['id_Friend']?>&login=<?=$person['Login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>" class="name"><?=$person['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
						<tr>
							<?php
							for ($i = 3; $i < 6; $i++)
							{ 
							$person = $Friends->fetch_assoc();
							$img_main_path = Get_Path_User_Avatar_by_id($person['id'], $person['img']);
							$img = "..\..\\".$img_main_path;
							?>
							<td>
								<div>
									<img src=<?=$img?> class="ava" alt="">
								</div>
								<a href="..\Another_Page\Another_Page.php?id=<?=$person['id_Friend']?>&login=<?=$person['Login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>" class="name"><?=$person['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
					</table>
				</div>
			</div>