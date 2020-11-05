function showRoleTable()
{
    if (document.getElementById("rolechangediv").style.display === "none")
        document.getElementById("rolechangediv").style.display="";
    else
        document.getElementById("rolechangediv").style.display="none";

    if (document.getElementById("menueditdiv").style.display === ""){
        document.getElementById("menueditdiv").style.display="none";
    }
}
function showMenuTable()
{
    if (document.getElementById("menueditdiv").style.display === "none")
        document.getElementById("menueditdiv").style.display="";
    else
        document.getElementById("menueditdiv").style.display="none";

    if (document.getElementById("rolechangediv").style.display === ""){
        document.getElementById("rolechangediv").style.display="none";
    }
}