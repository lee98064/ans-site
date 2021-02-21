require('./bootstrap');

$("input.select-all").click(function () {
    var checked = this.checked;
    $("input.select-item").each(function (index,item) {
        item.checked = checked;
    });
});


$('.view-online').click(function (e) { 

    alert('開發中!');
    e.preventDefault();
});

$('#file-type').change(function (e) { 
    location.href = '/books/' + $(this).data('book_id') + '?catalog=' + $(this).val();
    e.preventDefault();
});