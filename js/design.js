$(document).ready(function() {    

      $('#tableOffer .checkbox').each(function()
      {
            if($(this).attr("checked") == true && ($(this).attr("name") != "1" && $(this).attr("name") != "2")){
                $(this).attr("checked", false);
            }
      });

      $('#navigation ul li a').button();

      $('input:submit').button();
      
      $('.active').addClass('ui-state-active');

      $(".checkbox").click(function(){
            
            var priceSpan    = $(this).parent().siblings('td:eq(1)').children('span');
            var monthlySpan  = $(this).parent().siblings('td:eq(2)').children('span');
            var price        = parseFloat(priceSpan.text().replace(",", "."));
            var monthly      = parseFloat(monthlySpan.text().replace(",", "."));
	    var totalPrice   = parseFloat($("#total").text().replace(",", "."));
            var totalMonthly = parseFloat($("#monthly").text().replace(",", "."));
            
            if($(this).attr("checked") == true){
                  if (true == isNaN(price)){
                        monthlySpan.show();
                        totalMonthly = totalMonthly + monthly; 
                  }
                  else if(true == isNaN(monthly)){
                        priceSpan.show();
                        totalPrice = totalPrice + price;
                  }
            }else if($(this).attr("checked") == false){
                  if (true == isNaN(price)){
                        monthlySpan.hide();
                        totalMonthly = totalMonthly - monthly; 
                  }
                  else if(true == isNaN(monthly)){
                        priceSpan.hide();
                        totalPrice = totalPrice - price;
                  }
            }
      
            totalMonthly=totalMonthly.toString().replace(".", ",");
            $("#total").html(totalPrice);
            $("#monthly").html(totalMonthly);
      });
            
      $('#showtime').cycle({
            
            fx:   'shuffle', 
            shuffle: { 
                top:  -110, 
                left: -300 
            }, 
            delay: -6000 
      });
      
      $('#switch').hover(
            function () {
                  $('#imap').fadeOut('fast', function(){$('#gmap').fadeIn('fast');});
            },
            function () {
                  $('#gmap').fadeOut('fast', function(){$('#imap').fadeIn('fast');});
            }
      );
});