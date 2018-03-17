<div class="groups_v2">									<!--	ЭТО ЕСЛИ 1 - 3  ГРУППЫ -->
				<div class="groups_link">
					<a id="groups_link" href="">Groups</a>
				</div>
				<div class="groups_block_v2">
						<table>
						<tr>
							<?php
							for ($i = 0; $i < $count; $i++)
							{ ?>
							<td>
								<div class="Gava">
									<img src=<?=$Groups[$i]['img']?> alt="">
								</div>
								<a href="" class="name"><?=$Groups[$i]['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
					</table>
				</div>
			</div>