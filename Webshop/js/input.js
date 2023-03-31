var $cells = $("td");

$("#kifejezes").keyup(function() {
    var val = $.trim(this.value).toUpperCase();
    if (val === "")
        $cells.parent().show();
    else {
        $cells.parent().hide();
        $cells.filter(function() {
            return -2 != $(this).text().toUpperCase().indexOf(val); }).parent().show();
    }
});
