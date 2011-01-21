$(document).ready(function() {

      // Hide the page-content by default
      $('#page-content').hide();$('#page-info').show();

      // Use AJAX request to retrieve the pages details
      $('#file-tree ul li a').click(function(){     
            if ($('#actionTitle').html() != "Modifier une page du site")
            {
                  page_id = $(this).attr('rel');
                  $(this).attr('href','#');
                  
                  $.ajax({
                    type: "POST",
                    url: "http://localhost/itatom/admin/pages/ajax_page_details/" + page_id,
                    dataType: "html",
                    success: function(html){
                        $('#page-details').html(html);
                    }
                  });
            }
      });
      
      // Double check the intention of the user to record the changes
      $('#mid-col input:submit').click(function(){
            var answer = confirm("Etes-vous certain de vouloir enregistrer toutes les informations de cette page ?");
            if (answer){
                  alert("Toutes vos modifications ont ete enregistrees!");
                  return true;
            }
            confirm("Vous n'avez pas enregistre vos modifications !");
            return false;
      });

      $('#menu-page li a').click(function(){
            // Hide part of the content of the page
            switch($(this).attr("href"))
            {
                  case "#info":    $('#page-content').hide();$('#page-info').show();break;
                  case "#content": $('#page-info').hide();$('#page-content').show();break;
                  default: break;
            }
            // Put the class="active" to the right menu tab
            $(this).parent().siblings().children().removeClass(); 
            $(this).removeClass().addClass("active");
      });

});