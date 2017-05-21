/*
jQuery Scripts : Handling Ajax requests, GUI alterations and checks.
Written by Shane Nolan. K00205031.
*/

//Globals
var resultDisplayed = 0;

//Generic function for Ajax requests. Shortened code by over 100 lines.
function ajaxReq(domain, dat, docID, time){
  $.ajax({
      type: "POST",
      url: domain,
      data: dat,
      timeout: 5000,
      success: function(response) {
          $(docID).html(response);
          if(time > 0){
            setTimeout(function() {
                ajaxReq(domain, dat, docID, time)
            }, time);
          }
      },
      error: function(domain, docID) {
        setTimeout(function() {
            ajaxReq(domain, dat, docID, time)
        }, 5000);
    }
  })
}

function checkGame() {
    $.ajax({
        type: "POST",
        url: "/models/currentgame.php",
        success: function(response) {
          var remaining = response.match('[0-9]{1,2}');
            if(remaining != null){
              if(remaining < 15){
                betGUI(true);
                $('#betButton').text("Next Game In " + remaining);
                if(resultDisplayed == 0){
                  if(response.indexOf("Heads") >= 0){
                    $('.card').toggleClass('heads');
                  }else if(response.indexOf("Tails") >= 0){
                    $('.card').toggleClass('tails');
                  }
                  $("input[name=betAmount]").val("");
                  resultDisplayed = 1;
                }
              }else{
                if(response.indexOf("InGame") >= 0){
                  betGUI(true);
                  $('#betButton').text("Bet Placed");
                }
              }
            }else{
              betGUI(false);
              resultDisplayed = 0;
              $('#betButton').text("Place Bet");
            }

            setTimeout(function() {
                checkGame()
            }, 1000);
        }
    })
}

function betGUI(option) {
    $("#betAmount").prop("disabled", option);
    $('#betButton').prop("disabled", option);
    $('input[name=choice]').attr("disabled", option);
}

$(function() {
    $.getJSON("https://www.cpagrip.com/common/offer_feed_json.php?user_id=9594&pubkey=e1d50270311be58110bdb2b564c12bc7&callback=?",
        function(json_data) {
            var offer_text = '';
            var uid = $("#uid").val();
            $.each(json_data.offers, function(key, offer) {
                offer.offerlink = offer.offerlink.replace('www.cpagrip.com', 'motifiles.com');
                offer.offerlink += '&tracking_id=' + uid;
                offer_text += '<div class="col-lg-4"><div class="thumbnail text-center"><img id="offerphoto" src="' + offer.offerphoto + '" alt="Offer Preview"><div class="caption"><h3 id="offerTitle">' + offer.title + '</h3> <p><h4><span class="label label-success"><span class="glyphicon glyphicon-gift"></span> ' + (offer.payout * 1000) / 2 + '</span></h4></p> <p><a href="' + offer.offerlink + '" target="_blank" class="btn offerButton"><span class="glyphicon glyphicon-new-window"></span> Go To Offer</a></p></div></div></div>';
            });
            $(".offer_holder").html(offer_text);
        });

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        e.preventDefault();
    });

    if ($("#rEarnings").length) {
        ajaxReq("/models/recent.php", "earnings=true", "#rEarnings", 5000)
    }

    if ($("#rWinnings").length) {
        ajaxReq("/models/recent.php", "winnings=true", "#rWinnings", 5000)
    }

    if ($("#betCoinRoulette").length) {
      checkGame();
    }

    if ($("#LGD").length) {
        ajaxReq("/models/recent.php", "gamble=true", "#LGD", 2000);
    }

    if($("#topbar").text().indexOf("Login | Register") == -1){
      ajaxReq("/models/recent.php", "points=true", "#dPoints", 5000);
    }

    if ($("#chatBox").length) {
      ajaxReq("/models/chat.php", "", "#chatBox", 1000);
        // Scrollbar //
        setTimeout(function() {
            $("#chatBox").animate({
                scrollTop: $('#chatBox').prop("scrollHeight")
            }, 1000);
        }, 500);
    }

    $("#betCoinRoulette").on('submit', function(e) {
        e.preventDefault();

        var $form = $(this),
            data = "betAmount=" + $("#betAmount").val() + "&choice=" + $('input[name=choice]:checked').val(),
            url = $form.attr("action");
        if ($.trim($("#betAmount").val()) === '' || !$('input[name=choice]').is(':checked')) {
            $('#mMessage').find('.modal-body').text("Please enter a valid amount of points and select a coin.");
            $('#mMessage').modal('show');
        } else if (parseInt($.trim($("#betAmount").val())) > parseInt($("#pointsIcon").text().replace(/\D+/g, ''))) {
          $('#mMessage').find('.modal-body').text("You do not have enough points for that bet.");
          $('#mMessage').modal('show');
        } else {
          ajaxReq(url, data, "", 0);
        }
    });

    $("#chatSend").on('submit', function(e) {
        e.preventDefault();

        var $form = $(this),
            data = "messageBody=" + $form.find("#messageBody").val(),
            url = $form.attr("action");

        if ($("#messageBody").val().length < 3) {
            $("#cnotify").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oops!</strong> Your message was too short, try again.</div>');
        } else if($("#messageBody").val().length > 70){
          $("#cnotify").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oops!</strong> Your message is too long, try again.</div>');
        } else {
          ajaxReq(url, data, "", 0);
          $("#messageBody").val("");
        }
    });
});
