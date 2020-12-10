$(document).ready(function(){
// check change event of the text field
    $("#usernamereg").keyup(function(){
// get text username text field value
        var username = $("#usernamereg").val();

// check username name only if length is greater than or equal to 3
        if(username.length >= 3)
        {
            $("#status").html('<i class="fa fa-spinner fa-pulse fa-2x"></i> Checking availability...');
// check username
            $.post("incl/check_availability.php", {usernamereg: username}, function(data, status){
                $("#status").html(data);
            });
        } else{
            $("#status").html('');
        }
    });
});