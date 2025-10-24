// example.com/wp-admin/admin-ajax.php 

let query = {
    action: 'get_product_data',
    category: '',
    brand: '',
    posts_per_page: '',
}


// Ajax request for product category filter
jQuery('.category_block_left ul li a').on('click',function(event){
    event.preventDefault();
    const category = jQuery(this).attr('data-slug');  
    query.category = category;
    fetchData();
});

// Ajax request for brand filter
jQuery('.brand_block_left ul li a').on('click',function(event){
    event.preventDefault();
    const brand = jQuery(this).attr('data-slug'); 
    query.brand = brand;   
    fetchData();
});

jQuery('#posts_per_page').on('change',function(event){
    event.preventDefault();
    const posts_per_page = jQuery(this).val();  
    query.posts_per_page = posts_per_page;   
    fetchData();
});


function fetchData(){
     jQuery.post(ajax_handler.ajax_url, 
        query, 
        function(data) {
            jQuery('#products-list').empty().html(data);
        }
    );
}