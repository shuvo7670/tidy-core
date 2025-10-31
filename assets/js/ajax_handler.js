// example.com/wp-admin/admin-ajax.php 

let query = {
    action        : 'get_product_data',
    category      : '',
    brand         : '',
    posts_per_page: '',
    paged         : '',
    layout        : 'list',
    search        : '',
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

// pagination link ajax request
jQuery(document).on('click','#product-pagination a',function(event){
    event.preventDefault();
    const url_format = jQuery(this).attr('href');
    const paged = url_format.match(/\/page\/(\d+)\//);
    if( paged ) {
        query.paged = paged[1]; 
    }else {
        query.paged = jQuery(this).text();
    }
    fetchData();
});

// Grid and list view toggle
jQuery('#product-layout #list').on('click',function(event){
    event.preventDefault();
    query.layout = 'list';
    fetchData();
});
jQuery('#product-layout #grid').on('click',function(event){
    event.preventDefault();
    query.layout = 'grid';
    fetchData();
});

// Search functionality
let debounceTimer;
jQuery('#search').on('keyup', function (event) {
    event.preventDefault();
    const search = jQuery(this).val();
    query.search = search;
    query.paged = '';

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        fetchData();
    }, 1000); // 3 seconds
});

function fetchData(){
     jQuery.post(ajax_handler.ajax_url, 
        query, 
        function(data) {
            jQuery('#product-item-wrapper').empty().html(data);
        }
    );
}