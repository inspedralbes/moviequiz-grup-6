$('#registrar').click(function(){
    var username = $('#usuarioreg').val();
    var password = $('#passreg').val();
    var confirmpassword = $('#confirmpassreg').val();
    //AQUI
    $.ajax({
        url: "php/register.php",
        type: "post",
        data: {
            username: username,
            password: password,
            confirmpassword: confirmpassword
        },
        success: function(result){
            var msg= "";

            if (result=='OK'){
                printLogged();

            }else if(result == "REGISTROINCORRECTO"){
                msg= "El nombre usuario ya existe o las contraseñas no son iguales";   
            }else{
                msg="Los campos no pueden estar vacíos";
            }
            $("#messageReg").html(msg);
        }
    });

});