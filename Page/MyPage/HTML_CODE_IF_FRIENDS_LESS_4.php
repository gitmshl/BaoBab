<div class="friends_v2">								<!--	ЭТО ЕСЛИ 1 - 3  ДРУГА -->
				<div class="friends_link">
					<a id="friends_link" href="">Friends</a>
				</div>
				<div class="friends_block_v2">
					<table>
						<tr>
						<?php
							for ($i = 0; $i < $count; $i++)
							{ ?>
							<td>
								<div>
									<img src=<?=$Friends[$i]['img']?>  class="ava" alt="">
								</div>
								<a href="" class="name"><?=$Friends[$i]['Name']?></a>
							</td>
							<?php 
							} ?>
						</tr>
					</table>
				</div>
			</div>