<div class="friends_v1">								<!--	ЭТО ЕСЛИ 4 И БОЛЕЕ ДРУЗЕЙ  -->
				<div class="friends_link">
					<a id="friends_link" href="">Friends</a>
				</div>
				<div class="friends_block_v1">
					<table>
						<tr>
							<?php
							for ($i = 0; $i < 3; $i++)
							{ ?>
							<td>
								<div>
									<img src=<?=$Friends[$i]['img']?> class = "ava" alt="">
								</div>
								<a href="" class="name"><?=$Friends[$i]['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
						<tr>
							<?php
							for ($i = 3; $i < 6; $i++)
							{ ?>
							<td>
								<div>
									<img src=<?=$Friends[$i]['img']?> class="ava" alt="">
								</div>
								<a href="" class="name"><?=$Friends[$i]['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
					</table>
				</div>
			</div>