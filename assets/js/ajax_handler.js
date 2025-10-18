jQuery('#categories_block_left ul li a').on('click',function(event){
    event.preventDefault();

    const category = jQuery(this).attr('data-slug');    
    jQuery.post(ajax_handler.ajax_url, 
        {
            action: "get_product_data",
            category  : category,
        }, 
        function(data) {
            jQuery('#products-list').empty().html(data);
        }
    );
});



