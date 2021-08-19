$(document).ready(function () {

    validateOrder();

    // add product
    $(document).on('click', '.add-product-btn', function (e) {

        e.preventDefault();

        let productName = $(this).data('name');
        let productId = $(this).data('id');
        let productPrice = $(this).data('price');

        $(this).removeClass('add-product-btn btn-success').addClass('btn-default disabled');

        let html =
            `<tr>
                <td>${productName}<input type="hidden" name="products[]" value="${productId}"></td>
                <td><input type="number" name="quantities[]" value="1" min="1" class="form-control input-sm quantity" required data-price="${productPrice}"></td>
                <td class="price" data-price="${productPrice}">${productPrice}</td>
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${productId}"><i class="fa fa-trash"></i></button></td>
            </tr>`

        $('.order-list').append(html);

        $('.total-price').html($.number(calculateSum(), 2));

        validateOrder();

    });

    //disabled
    $(document).on('click', '.disabled', function(e) {
        e.preventDefault();
    });

    // remove product
    $(document).on('click', '.remove-product-btn', function() {

        let productId = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + productId).removeClass('btn-default disabled').addClass('btn-success add-product-btn');

        $('.total-price').html($.number(calculateSum(), 2));

        validateOrder();

    });

    // change quantity
    $(document).on('keyup change', '.quantity', function () {

        let quantity = Number($(this).val());
        let unitPrice = Number($(this).data('price'));
        let price = quantity * unitPrice;

        $(this).closest('tr').find('.price').data('price', price).html($.number(price, 2));

        $('.total-price').html($.number(calculateSum(), 2));

    });

    //print
    $(document).on('click', '.print-btn', function() {

        $('#print-area').printThis();
    });

    $('.order-products').click(function () {

        $('#loading').css('display', 'flex');
        $('#order-product-list').css('display', 'none');

        let url = $(this).data('url');

        $.ajax({
            url: url,
            success: function (data) {

                $('#loading').css('display', 'none');
                $('#order-product-list').css('display', 'block');
                $('#order-product-list').empty().append(data);

            }//end of success
        })
    });

    $('.order-status-btn').on('click', function () {

        let status = $(this).data('status');
        let availableStatus = $(this).data('available-status');
        let that = $(this);

        //processing, finished
        if (status == availableStatus[0]) {

            that.text(availableStatus[1])
            that.removeClass('btn-warning').addClass('btn-success disabled');

            let url = $(this).data('url');
            let method = $(this).data('method');
            let csrf = $('meta[name="csrf-token"]').attr('content');

            let data = {
                '_token': csrf,
                'status': 'finished'
            }

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function (data) {

                }
            })

        }//end of if

    });


});

function calculateSum() {

    var sum = 0
    $('.price').each(function () {
        sum += Number($(this).data('price'));
    });

    return sum;

}//end of calculate sum

function validateOrder() {

    if ($('.order-list').children().length > 0) {
        $('#form-btn').removeClass('disabled');
    } else {
        $('#form-btn').addClass('disabled');
    }

}//end of validate order

