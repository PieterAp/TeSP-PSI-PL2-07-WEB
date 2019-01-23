$(".selection-1").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect1')
});
$(".selection-2").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect2')
});
$('.block2-btn-addcart').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).on('click', function(){
        swal(nameProduct, "is added to cart !", "success");
    });
});
$('.block2-btn-addwishlist').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");
    });
});
$('.parallax100').parallax100();


$('.btn-addcart-product-detail').each(function(){
    var nameProduct = $('.product-detail-name').html();
    $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");
    });
});
$('.lol').click(function(){
    if ($("#minuss").hasClass('fa-minus')) {
        $("#minuss").removeClass("fa-minus");
    }else{
        $("#minuss").addClass("fa-minus");
    }
});

function compraDeleteAJAX($url,$id,$csrf){
    $.ajax({
        url: $url + '/compra/delete',
        type: 'post',
        data: {
            idproduto: $id ,
            _csrf : $csrf
        }
    })
        .done( function (data) {
            $(".data1").find(".values"+data.check).eq(0).remove();
            $(".data").find(".values"+data.check).eq(0).remove();
            $(".item").find(".values"+data.check).eq(0).remove();
            $(".newtable").find(".values"+data.check).eq(0).remove();
            $(".total").html("Total: "+data.total +"€");
            $(".header-icons-noti").html(data.count[0].count);
            if(!$(".table-row")[0]){
                $(".comprabuttom").remove();
            }
        })
        .fail( function (xhr, textStatus, errorThrown){
            $(".total").html("Something went wrong, refresh page and if this error persists, contact support");
            console.log(errorThrown);
        });
}


