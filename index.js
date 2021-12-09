document.getElementById("btnSearch").addEventListener("click", function(){
    let nombre= document.getElementById("search").value;
    fetch(`https://www.omdbapi.com/?apikey=e4fb6781&s=${nombre}`).then(function(res) {
    return res.json();
    }).then(function(data) {
    console.log(data);

    let pelis = "";
    for(i=0; i<10; i++){
        datos = data.Search[i];
        pelis += `<div class="col s3 m6 l3">
                    <div class="card">
                        <div class="card-image">
                            <img src="${datos.Poster}" class="style_img">
                            <span class="card-title">${datos.Title}</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">+</i></a>
                        </div>
                    </div>
                 </div>`;
    }
    document.getElementById("items").innerHTML=pelis;
    }).catch(function() {
    //console.log("problem!");
    });
});

document.getElementById("btnLogin").addEventListener("click", function(){
    let u = document.getElementById("username").value;
    let p = document.getElementById("pwd").value;

    const datosEnvio = new FormData();

    datosEnvio.append('username', u);

    datosEnvio.append('pwd', p);

    fetch(`http://localhost/moviequiz-grup-6/login.php`, {
        //fetch(`https://labs.inspedralbes.cat/~aperezh/login2.php`
        //(xampp)
        method: 'POST',

        body: datosEnvio

    })

    .then(response => response.json())

    .then(data => {

        console.log(data);
        if(data.exito==false){
            alert("Usuari o contrasenya incorrecta");
        }else{
            document.getElementById("divSearch").style.display="block";
            document.getElementById("divLogin").style.display="none";
        }
        
    })
});