import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Set the CSRF token globally for all AJAX requests to avoid CSRF mismatch
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {
    function updateTotalPrice() {
        let totalPrice = 0;
        $('.list-group-item').each(function () {
            totalPrice += parseFloat($(this).data('price')) * parseInt($(this).data('quantity'));
        });

        $('#total-price').text('£' + totalPrice.toFixed(2));
    }

    updateTotalPrice();

    const sortableList = document.querySelector('.sortable-list');
    new Sortable(sortableList, {
        animation: 150,
        ghostClass: 'blue-background-class',
        onEnd: function (event) {
            const itemIds = Array.from(sortableList.children).map(item => item.dataset.itemId);

            // Send AJAX request with the CSRF token automatically included
            $.ajax({
                url: '/shopping-list/reorder',
                type: 'POST',
                data: {
                    itemIds: itemIds
                }
            });
        }
    });
});


$('.list-group').on('click', '.list-group-item', async function () {
    if (event.target.closest('a, form')) return;

    const listItem = $(this);
    const {itemId} = listItem.data();

    $.ajax({
        url: `/shopping-list/${itemId}/check`,
        type: 'POST',
        success: function (response) {
            if (response.success) {
                listItem.toggleClass('text-decoration-line-through');
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});

