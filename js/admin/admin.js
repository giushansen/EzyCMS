$(document).ready(function() {

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

});