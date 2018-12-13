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
$('.dropdown1').click(function(){

    if ($('.down1').css('display') == 'none') {
        $(".down1").css("display", "block");
        $(".plus1").removeClass("fa-plus");
        $(".plus1").addClass("fa-minus");
    }else{
        $(".down1").css("display", "none");
        $(".plus1").addClass("fa-plus");
        $(".plus1").removeClass("fa-minus");
    }
});

$('.dropdown2').click(function(){

    if ($('.down2').css('display') == 'none') {
        $(".down2").css("display", "block");
        $(".plus2").removeClass("fa-plus");
        $(".plus2").addClass("fa-minus");
    }else{
        $(".down2").css("display", "none");
        $(".plus2").addClass("fa-plus");
        $(".plus2").removeClass("fa-minus");
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
            $(".values"+data.check).remove();
            $(".total").html("Total:"+data.total);
            $(".header-icons-noti").html(data.count);
            $(".comprabuttom").remove();
        })
        .fail( function (xhr, textStatus, errorThrown){
            $(".total").html("Something went wrong, refresh page and if this error persists, contact support");
            console.log(errorThrown);
        });
}

