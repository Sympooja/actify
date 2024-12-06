<div class="ui stackable grid" id="manage" style="display: none;">

<!-- ************************************************************************************************ -->
<!-- ************************************ Manage/Welcome Message ************************************ -->
<!-- ************************************************************************************************ -->

	<div class="sixteen wide column" id="welcomePersonalized">
		<h1>
			Welcome back <span id="useremail"></span>
		</h1>

		<h3>It's easy to update your information, just <a class="red" href="#" id="managelink">go to manage subscription preferences</a> to customize the types of emails you receive.
		</h3>

	<div class="sixteen wide column center aligned" id="manageButtons">
		<div class="ui green button" id="EmmaManage">
			Manage Preferences
		</div>
	</div>

<div class="ui divider"></div>

		<h3>
			If you choose to unsubscribe from all of our emails, just confirm below. We hope that you'll be back soon.
		</h3>
		<div class="ui green inverted button" id="EmmaUnsubscribe">
			Unsubscribe All
		</div>
	</div>

<!-- ************************************************************************************************ -->
<!-- ****************************************** Secondary ******************************************* -->
<!-- ************************************ Email Not Found Message *********************************** -->
<!-- ************************************************************************************************ -->

	<div class="sixteen wide column" id="manageNoEmail" style="display: none;">
		<div class="row">
			<div class="ui yellow small message">
				We're sorry, but we couldn't find that email address. Please try again or use our <a href="index.php">signup form</a> to join.
			</div>
		</div>
	</div>

<!-- ************************************************************************************************ -->
<!-- ****************************************** Secondary ******************************************* -->
<!-- *********************************** Email Found - Update Info ********************************** -->
<!-- ************************************************************************************************ -->

	<div class="ui stackable grid headerText" id="manageWelcome" style="display: none;">
		<div class="sixteen wide column">
			<h3>
				Please update your information below. At Actify we have exciting offers and news about our products and services that we hope you’d like to hear about.
			</h3>
		</div>
	</div>

<!-- ************************************************************************************************ -->
<!-- ****************************************** Secondary ******************************************* -->
<!-- ********************************** Thanks for Updating Message ********************************* -->
<!-- ************************************************************************************************ -->

	<div class="ui stackable grid" id="manageThanks" style="display: none;">
		<div class="sixteen wide column">
			<h5>
				Thanks for updating your information. Look for more great emails soon.
			</h5>

		</div>

	</div>

<!-- ************************************************************************************************ -->
<!-- ****************************************** Secondary ******************************************* -->
<!-- ********************************** Error Updating Info Message ********************************* -->
<!-- ************************************************************************************************ -->

	<div class="sixteen wide column" id="formHeaderError" style="display: none;">
		<div class="row">
			<div class="ui red small message">
				There was an error updating your information.
			</div>
		</div>
	</div>

<!-- ************************************************************************************************ -->
<!-- ********************************* Opting Out Selection Message ********************************* -->
<!-- ************************************************************************************************ -->

	<div class="sixteen wide column" id="sorry" style="display: none;">
		<h1>
			We're sad to see you go!
		</h1>

		<h3>
			If you change your mind and don't want to miss out, you can <a href="https://signup.e2ma.net/signup/<?php echo $form_id . "/" . $account_id; ?>/" target="_blank">click here</a> to begin the process of opting back in to our email program.
		</h3>

	</div>

<!-- ************************************************************************************************ -->
<!-- ****************************************** Secondary ******************************************* -->
<!-- *********************************** Already Opted Out Message ********************************** -->
<!-- ************************************************************************************************ -->

	<div id="previousOptout" class="sixteen wide column" id="classic" style="display: none;">

			<div class="ui yellow small message">
				We're sorry, but it looks like you've previously opted out. <a href="https://signup.e2ma.net/signup/<?php echo $form_id . "/" . $account_id; ?>/" target="_blank">Click here</a> to begin the process of opting back in.
			</div>

	</div>



</div>