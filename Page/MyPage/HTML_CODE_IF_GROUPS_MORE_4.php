<div class="groups_v1">								<!--	ЭТО ЕСЛИ 4 И БОЛЕЕ ГРУПП  -->
				<div class="groups_link">
					<a id="groups_link" href="">Groups</a>
				</div>
				<div class="groups_block_v1">
					<table>
						<tr>
							<?php
							for ($i = 0; $i < 3; $i++)
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
						<tr>
							<?php
							for ($i = 3; $i < 6; $i++)
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