$( document ).ready(function() {
    $(".btn-gro i").on("click", function(){
        var id = $(this).attr("data-id");
        var dataoperation = $(this).attr("data-operation");
        _this = $(this);
        $.ajax({
            type:"GET",
            dataType: "json",
            url: "/product/carts/quantity/"+id+'/'+dataoperation,
            success: function(result){
                _this.parents('tr').find('.cart-amount').html(result['amount']);
                _this.parent().find('span').html(result['quantity']);
            }
        });
    });
});
// cart-amount