(function($){
    var modal = document.getElementById("myModal");
    var btn = document.getElementsByClassName("woocommerce-LoopProduct-link button");
    var span = document.getElementsByClassName("close")[0];
    
    function getDataId(name) {
        $.ajax({
            type: 'GET',
            url: WPR.ajax_url,
            data: {
                action: 'show_product',
                item: name,
            }
        }).then(function(res) {
            var data = JSON.parse(res);
            var html = `<div class="col-1">
                            <h2>${data['title']}</h2>
                            ${data['image']}
                            <button class="details">
                                <a href="${data['url']}">View FULL product details</a>
                            </button>
                          </div>
                          <div class="col-2">
                            <h2>${data['price']}</h2>
                            <p>${data['short_description']}</p>
                            <hr>
                            ${data['summary']}
                           </div>`;
                        
            // $('#modal-body').html(data.content);
            $('#modal-body').append(html);
            console.log(data);
           
        })
    }


    $('.woocommerce-LoopProduct-link button').click(function(e){
        e.preventDefault();
        $('#modal-body').empty();
        modal.style.display = "block";
        var product_id = $(this).attr('data-id');
        getDataId(product_id);
    });
    $('.close').click(function(){
        modal.style.display = "none";
    });
})(jQuery);