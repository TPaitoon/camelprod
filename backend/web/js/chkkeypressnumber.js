function chknumber(event) {
    var key = window.event ? event.keyCode : event.which;
    //alert(key);
    if (key === 8 || key === 46 || key === 37 || key === 39 || key === 0) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    }
    return true;
}