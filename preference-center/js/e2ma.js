jQuery(document).ready(function() {
  jQuery("#form").trigger("reset");

  /* set form options on load */

  jQuery(
    "#manage, #classic, #sorry, #form, #formHeaderError, #formHeaderSuccess, #manageNoEmail"
  ).hide();
  jQuery("#content").addClass("loading");

  /* Gets Values from URL parameters/querystrings */
  function GetQueryStringParams(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sPageURL = decodeURIComponent(sPageURL);
    var sURLVariables = sPageURL.split("&");
    for (var i = 0; i < sURLVariables.length; i++) {
      var sParameterName = sURLVariables[i].split("=");
      if (sParameterName[0] == sParam) {
        return sParameterName[1];
      }
    }
  }

  var source = GetQueryStringParams("source");
  var e = GetQueryStringParams("e");
  var mid = GetQueryStringParams("mid");
  var action = GetQueryStringParams("action");
  var format = GetQueryStringParams("format");

  jQuery("#id_source").val(source);
  jQuery("#email").val(e);
  jQuery("#useremail").html(e);

  if (action === undefined && e != undefined) {
    /* Manage and Optout */
    jQuery("#manage").show();
    var submitAction = "update";
  } else if ((action == "signup" && format == "embed") || format == "embed") {
    jQuery("#masthead, .site-footer").hide();
    jQuery("body").removeClass("body");
    jQuery("#EmmaSubmit").html("Sign Up");
    jQuery("#form, #signup, #signupWelcome").show();
  } else if (action == "signup" || e === undefined) {
    /* Signup */
    jQuery("#EmmaSubmit").html("Sign Up");
    jQuery("#form, #signup, #signupWelcome").show();
    var submitAction = "signup";
  } else if (action == "manage" && e != undefined) {
    /* Manage */
    jQuery("#manage").show();
    jQuery("#manageButtons, #welcomePersonalized").hide();
    jQuery("#form, #manageWelcome").fadeIn();
    var submitAction = "update";
  } else if (action == "optout" && e != undefined) {
    /* Manage */
    jQuery("#manage").show();
    var submitAction = "update";
  } else {
    /* default action - signup */
    jQuery("#EmmaSubmit").html("Sign Up");
    jQuery("#form, #signup, #signupWelcome").show();
    var submitAction = "signup";
  }

  /* get member record via ajax calling e2ma-get.php */
  var memberData;

  jQuery.ajax({
    type: "GET",
    url: "api/e2ma-get.php?memberid=" + mid + "&email=" + e,
    async: false,
    contentType: "application/json",
    dataType: "json",
    success: function(data) {
      memberData = JSON.stringify(data);
      var obj = $.parseJSON(memberData);

      if (obj["error"] == "User not found.") {
        jQuery("#welcomePersonalized, #manageButtons").hide();
        jQuery("#manageNoEmail").fadeIn();
      } else if (obj["status"] == "opt-out") {
        jQuery("#welcomePersonalized, #manageButtons").hide();
        jQuery("#previousOptout").fadeIn();
        jQuery("#form").removeClass("loading");
      } else if (typeof data.error == "undefined") {
        populateForm();
        jQuery("#form").removeClass("loading");
      } else {
        jQuery("#manageNoEmail").fadeIn();
        jQuery("#form").removeClass("loading");
      }
    },
    error: function(e) {
      jQuery("#formHeaderError").fadeIn();
      jQuery("#form").removeClass("loading");
    }
  });

  /* Parse JSON returned from Emma to populate form */
  function populateForm() {
    var obj = $.parseJSON(memberData);

    jQuery("#id_member_id").val(obj["member_id"]);
    jQuery("#email").val(obj["email"]);
    jQuery("#first_name").val(obj.fields["first_name"]);
    jQuery("#last_name").val(obj.fields["last_name"]);
    jQuery("#phone").val(obj.fields["phone"]);
    jQuery("#postal_code").val(obj.fields["zip-code"]);
    jQuery(
      "#custom-country option[value='" + obj.fields["custom-country"] + "']"
    ).prop("selected", true);

    /* check existing corp comm communications */
    jQuery.each(obj.fields["communications"], function(i, code) {
      jQuery(
        "input[name='communications'][value='" +
          obj.fields["communications"][i] +
          "']"
      ).prop("checked", true);
    });

    /* hide the form if email exists but opted out */
    if (obj["status"] == "opt-out") {
      jQuery("#EmmaUnsubscribe, #EmmaSubmit").hide();
      jQuery("#classic").show();
    } else if (obj["status"] == "error") {
      jQuery("#formHeaderError").fadeIn();
    }
  }
  /* end form population */

  /* format dropdowns after data loaded */
  jQuery(".ui.dropdown").dropdown();

  /* Load Manage Page on Click */
  jQuery("#EmmaManage, #managelink").bind("click", function(e) {
    /* Prevents the default action to be triggered */
    e.preventDefault();

    /* loads manage page with memberid */
    jQuery("#welcomePersonalized, #manageButtons").hide();
    jQuery("#form, #manageWelcome").fadeIn();
  });

  /**** Begin Form Update Functions ****/

  /* Begin Opt Out Code */
  jQuery("#EmmaUnsubscribe").click(function() {
    var email = jQuery("#email").val();
    var email = encodeURIComponent(email);
    var data = "{}";

    jQuery.ajax({
      type: "POST",
      cache: false,
      async: false,
      url: "api/e2ma-optout.php?email=" + email,
      data: data,
      contentType: "application/json",
      dataType: "json",
      beforeSend: function() {
        jQuery("#form").addClass("loading");
      },
      success: function(response) {
        if (response == 1) {
          jQuery("#welcomePersonalized,#manageButtons").fadeOut();
          jQuery("#sorry").fadeIn();
          jQuery("#form").removeClass("loading");
        }
      },
      error: function(postjson) {
        jQuery("#formHeaderError").fadeIn();
        jQuery("#form").removeClass("loading");
      }
    });
  });
  /* End Opt Out Code */

  /* Validates form and submits if validation is passed */
  jQuery("#form").form({
    on: "blur",
    fields: {
      first_name: {
        identifier: "first_name",
        rules: [
          {
            type: "empty",
            prompt: "Please enter your First Name"
          }
        ]
      },
      last_name: {
        identifier: "last_name",
        rules: [
          {
            type: "empty",
            prompt: "Please enter your Last Name"
          }
        ]
      },
      email: {
        identifier: "email",
        rules: [
          {
            type:
              "regExp[/^[-a-z0-9~!$%^&*_=+}{'?]+(.[-a-z0-9~!$%^&*_=+}{'?]+)*@([a-z0-9_][-a-z0-9_]*(.[-a-z0-9_]+)*.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}))(:[0-9]{1,5})?$/i]",
            prompt: "Please enter a valid Email"
          }
        ]
      },
      phone: {
        identifier: "phone",
        rules: [
          {
            type: "empty",
            prompt: "Please enter your Phone Number"
          }
        ]
      },
      country: {
        identifier: "country",
        rules: [
          {
            type: "empty",
            prompt: "Please select your Country"
          }
        ]
      },
      zip: {
        identifier: "postal_code",
        rules: [
          {
            type: "empty",
            prompt: "Please enter your Zip Code"
          }
        ]
      },
      communications: {
        identifier: "communications",
        rules: [
          {
            type: "checked",
            prompt: "Please select at least one Newsletter"
          }
        ]
      }
    },
    onSuccess: function() {
      $form = jQuery(this);
      $_form = jQuery(this).find("#form");
      $form.addClass("loading");

      var memberid = jQuery("#id_member_id").val();
      var email = jQuery("#email").val();
      var fname = jQuery("#first_name").val();
      var lname = jQuery("#last_name").val();
      var phone = jQuery("#phone").val();
      var zip = jQuery("#postal_code").val();
      var country = jQuery("#custom-country :selected").val();

      /* calucalte Signup/Manage Date */
      var d = new Date();

      var month = d.getMonth() + 1;
      var fullmonth = (month < 10 ? "0" : "") + month;
      var day = d.getDate();
      var fullday = (day < 10 ? "0" : "") + day;
      var year = d.getFullYear();

      var formDate = fullmonth + "/" + fullday + "/" + year;

      var prefs = jQuery("input[name='communications']:checked")
        .map(function() {
          return '"' + jQuery(this).val() + '"';
        })
        .get();

      if (submitAction == "update") {
        updateMember();
      } else if (submitAction == "signup") {
        addMember();
      } else {
        addMember;
      }

      function addMember() {
        var accountid = "1810330";
        var groupid = "6869914";

        /* Combine variables and prepare to submit to Emma */
        var data =
          '{"first_name": "' +
          fname +
          '","last_name": "' +
          lname +
          '","phone": "' +
          phone +
          '","zip-code": "' +
          zip +
          '","custom-country": "' +
          country +
          '","join-date": "' +
          formDate +
          '","communications": [' +
          prefs +
          '],"input-source": "' +
          source +
          '","email": "' +
          email +
          '","optInConfirmation": false,"accountId": "' +
          accountid +
          '","groups": [' +
          groupid +
          "]}";

        jQuery
          .ajax({
            type: "POST",
            cache: false,
            url: "https://signup-collector.e2ma.net/signup",
            data: data,
            contentType: "application/json",
            dataType: "text",
            success: function(text) {
              var json = text ? $.parseJSON(text) : null;
            }
          })
          .done(function(data) {
            jQuery("#form, #signupWelcome").fadeOut();
            jQuery("#form").removeClass("loading");
            jQuery("#signupThanks").show();
          })
          .fail(function(jqXHR, textStatus) {
            jQuery("#form").removeClass("loading");
          });
      }

      function updateMember() {
        /* Combine variables and prepare to submit to Emma */
        var data =
          '{"email": "' +
          email +
          '","status": "a","fields": {"first_name": "' +
          fname +
          '","last_name": "' +
          lname +
          '","phone": "' +
          phone +
          '","zip-code": "' +
          zip +
          '","custom-country": "' +
          country +
          '","communications": [' +
          prefs +
          '],"updated": "' +
          formDate +
          '","input-source": "' +
          source +
          '"}}';

        jQuery.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: "api/e2ma-update.php?memberid=" + memberid,
          data: data,
          contentType: "application/json",
          dataType: "json",
          beforeSend: function() {
            jQuery("#e2ma-update").addClass("loading");
          },
          success: function(response) {
            if (response == 1) {
              jQuery("#form, #manageWelcome").hide();
              jQuery("#manageThanks").show();
              jQuery("#form").removeClass("loading");
            }
          },
          error: function(postjson) {
            jQuery("#formHeaderError").fadeIn();
            jQuery("#form").removeClass("loading");
          }
        });
      }

      return false;
    }
  });
  //End form validation and submit options
});
