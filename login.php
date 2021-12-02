<?php

$user = $_POST['username'];

$pwd = $_POST['pwd'];

$timer=rand(1,7);

sleep($timer);

if (($user == "user")  && ($pwd == "1234")) {

        session_start();

        $arr = array ('exito'=>true,'nombre'=>"Alvaro Perez",'imagen'=>'https://randomuser.me/api/portraits/men/23.jpg'); ;    

} 

else {

        $arr = array ('exito'=>false);

}

$myJSON = json_encode($arr);

echo $myJSON;

?>

====================================JAVASCRIPT==============================

let u = document.getElementById("username").value;

let p = document.getElementById("pwd").value;



            const datosEnvio = new FormData();

            datosEnvio.append('username', u);

            datosEnvio.append('pwd', p);



fetch(`https://labs.inspedralbes.cat/~aperezh/login2.php`, {

                    method: 'POST',

                    body: datosEnvio

                })

                .then(response => response.json())

                .then(data => {

                    console.log(data);