$(document).ready(function () {

    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');

        $(this).removeClass('btn-success').addClass('btn-default disabled');

        var html = `
            <tr>
                <td>${name}</td>
                <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price"">${price}</td>
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><i class="fa fa-trash"></i></button></td>
            </tr>
        `;

        $('.order-list').append(html);

        // to Calculate total price
        calculateTotal();
    });

    //disabled btn
    $('body').on('click', '.disabled', function(e) {

        e.preventDefault();

    });//end of disabled

    //remove product btn
    $('body').on('click', '.remove-product-btn', function(e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        // to Calculate total price
        calculateTotal();

    });//end of remove product btn

    $('body').on('keyup change', '.product-quantity', function () {

        var unitPrice = $(this).data('price');
        var quantity = parseInt($(this).val());
        $(this).closest('tr').find('.product-price').html((unitPrice * quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'))

        calculateTotal();
    })

}); // end of document ready

//calculate the total
function calculateTotal() {

    var price = 0;

    $('.order-list .product-price').each(function(index) {

        price += parseFloat($(this).html().replace(/,/g, ''));

    });//end of each product price

    // $('.total-price').html($.number(price, 2));
    $('.total-price').html(price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));


    //check if price > 0
    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled')

    } else {

        $('#add-order-form-btn').addClass('disabled')

    }//end of else

}//end of calculate total

// accounting.formatMoney(4999.99, "€", 2, ".", ","); // €4.999,99
// console.log(typeof (price), price);
// console.log('-');
