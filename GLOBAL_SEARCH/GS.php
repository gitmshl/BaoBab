 <!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title>My page</title>
	<link rel="stylesheet" href="css/global_search_page_style.css">
	<link rel="stylesheet" href="fonts/fonts.css">
	<link rel="stylesheet" href="fonts/rubik/rubik.css">
	<link rel="stylesheet" href="fonts/roboto_vk_font/roboto_vk_font.css">
 </head>
 <body>
 	<header>
			<div class="header">
				<div class="subheader">
					<div class="logo"></div>
					<div class="search_block">
						<form action="">
							<div class="search_field">
									<input type="text" id="search_input" name = "Global_Search_Line" class="placeholder_style" placeholder="Search...">
									<input type="image" id="search_button" src="images/search_button.png" alt="Search">
							</div>
						</form>
					</div>
					<div class="right_column">
						<div class="signOut_block">
							<form action="">
								<div class="signOut_a">
									<a class="right_top" href="..\Common_Buttons\Options_And_Exit\Options_And_Exit.php">Sign out</a>
								</div>
							</form>
						</div>
						<div class="options_block">
							<form action="">
								<div class="options_a">
									<a class="right_top" href="OPTIONS">Options</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</header>
	<div class="clear"></div>
	<div class="wrapper">
		<div class="leftSidebar">
			<ul class="left_sidebar_ul">
				<li>
					<div class="my_page">
						<a href="MyPage.php">
							My page
						</a>
					</div>
				</li>
				<li>
					<div class="my_friends">
						<a href="">
							My friends
						</a>
					</div>
				</li>
				<li>
					<div class="my_news">
						<a href="">
							My news
						</a>
					</div>
				</li>
				<li>
					<div class="my_groups">
						<a href="">
							My groups
						</a>
					</div>
				</li>
			</ul>
		</div>
		
		<div class="global_search_middle_content">
			<div class="search_friends_v1">								<!--	ÝÒÎ ÅÑËÈ 4 È ÁÎËÅÅ ÄÐÓÇÅÉ  -->
				<div class="search_friends_link">
					<a id="search_friends_link" href="">People</a>
				</div>
				<div class="search_friends_block_v1">
					<table class="table">
						<tr>
							<td>
								<div>
									<img src="images/bg.jpg" class="ava" alt="">
								</div>
								<a href="" id="name" class="name">NAME</a>
							</td>
							<td>
								<div>
									<img src="images/222.jpg" class="ava" alt="">
								</div>
								<a href="" id="name" class="name">NAME</a>
							</td>
							<td>
								<div>
									<img src="images/bg.jpg" class="ava" alt="">
								</div>
								<a href="" id="name" class="name">NAME</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="search_groups_v1">								
				<div class="search_groups_link">
					<a id="search_groups_link" href="">Groups</a>
				</div>
				<div class="search_groups_block_v1">
					<table class="table">
						<tr>
							<td>
								<div>
									<img src="images/222.jpg" class="ava" alt="">
								</div>
								<a href="" class="name">NAME</a>
							</td>
							<td>
								<div>
									<img src="images/bg.jpg" class="ava" alt="">
								</div>
								<a href="" class="name">NAME</a>
							</td>
							<td>
								<div>
									<img src="images/222.jpg" class="ava" alt="">
								</div>
								<a href="" class="name">NAME</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="search_smth_block">
				<div class="profile_block">
					<img src="images/bg.jpg"  class="profile_photo" alt="">
					<div class="profile_name">
						<a href="#" class="profile_name_link">First name Last name</a>
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="rightSidebar">
			<ul class="right_sidebar_ul">
				<li>
						<div class="search_all">
							<a href="">
								Search All
							</a>
						</div>
				</li>	
				<li>
						<div class="search_friends">
							<a href="">
								People
							</a>
						</div>
				</li>
				<li>
					<div class="search_groups">
						<a href="">
							Groups
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>	
	
 </body>
 </html>