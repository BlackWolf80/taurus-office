$('.add_mylist_prod').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    $.ajax({
        url: '/cards/view',
        data: {id: id},
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            showWish(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});