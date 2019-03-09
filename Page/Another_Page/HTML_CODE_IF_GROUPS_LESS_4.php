<div class="groups_v2">									<!--	ЭТО ЕСЛИ 1 - 3  ГРУППЫ -->
				<div class="groups_link">
					<a id="groups_link" href="">Groups</a>
				</div>
				<div class="groups_block_v2">
						<table>
						<tr>
							<?php
							for ($i = 0; $i < $count; $i++)
							{ 
							$group = $Groups->fetch_assoc();
							//$img_main_path = Get_Path_User_Avatar_by_id($person['id'], $person['img']);
							//$img = "..\..\\".$img_main_path;
							?>
							<td>
								<div class="Gava">
									<img src="" alt="">
								</div>
								<a href="" class="name"><?=$group['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
					</table>
				</div>
			</div>