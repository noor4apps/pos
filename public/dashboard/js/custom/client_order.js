$(document).ready(function () {

    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');

        var html = `
            <tr>
                <td>${name}</td>
                <td><input type="number" name="quantity[]" class="form-control" min="1" value="1"></td>
                <td>${price}</td>
                <td><button class="btn btn-danger btn-sm"><i class="fa fa-trash "></i></button></td>
            </tr>
        `;

        $('.order-list').append(html);

        // console.log(typeof (price), price);
        // console.log('-');
    });

}); // end of document ready

// accounting.formatMoney(4999.99, "€", 2, ".", ","); // €4.999,99
