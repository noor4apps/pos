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
                <td><input type="number" name="quantity[]" class="form-control input-sm" min="1" value="1"></td>
                <td>${price}</td>
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><i class="fa fa-trash "></i></button></td>
            </tr>
        `;

        $('.order-list').append(html);

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

    });//end of remove product btn

}); // end of document ready

// accounting.formatMoney(4999.99, "€", 2, ".", ","); // €4.999,99
// console.log(typeof (price), price);
// console.log('-');
