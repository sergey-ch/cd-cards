$(document).on('click', '#delete', function (e) {
    const deleteLink = $(this);
    const id = deleteLink.data('id');
    
    e.preventDefault();
    
    $.ajax({
        url: deleteLink.attr('href'),
        data: {id},
        method: 'POST',
        type: 'JSON'
    }).done(function (response) {
        if (response && response.result) {
            deleteLink.closest('.card').remove();
        } else {
            // @todo process error
        }
    })
});