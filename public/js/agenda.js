$('#form input').keydown(function(e) {
    if (e.keyCode == 13) {
        $('#form').submit();
    }
});