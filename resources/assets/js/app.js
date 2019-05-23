/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

setTimeout(function() {
    $('.alert').slideUp(500);
}, 3000);


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.product-count-increment, .product-count-decrement').click(function() {
    var id = $(this).attr('data-id'); //view kısmında belirttik
    var count = $(this).attr('data-count');
    alert("sdf");
    $.ajax({
        type: 'PATCH',

        url: '/shoppingcart/update/' + id,
        data: { count: count },
        success: function() {
            //if(result == 'success') Buradaki yukarıdan gelen result değişkeni shopping cart controler içerisindeki update moetodunun içindeki
            //response()->json(['success'=>true]) kısmından gelebilmektedir.
            window.location.href = '/shoppingcart';
        }
    });
});