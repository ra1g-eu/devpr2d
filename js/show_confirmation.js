function confirmSubmit()
{
    var agree=confirm("Do you really want to do this?");
    if (agree)
        return true ;
    else
        return false ;
}