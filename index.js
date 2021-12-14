document.getElementById("btnSearch").addEventListener("click", function(){
    let nombre= document.getElementById("search").value;
    fetch(`https://www.omdbapi.com/?apikey=e4fb6781&s=${nombre}`).then(function(res) {
    return res.json();
    }).then(function(data) {
    console.log(data);

    let pelis = "";
    for(i=0; i<10; i++){
        datos = data.Search[i];
        pelis += `<div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-image">
                            <img src="${datos.Poster}" class="style_img">
                            <span class="card-title">${datos.Title}</span>
                            <a id="btn-modal" class="btn-floating halfway-fab waves-effect waves-light red" href="#modal${i}"><i class="material-icons">+</i></a>
                        </div>
                    </div>
                    <div id="modal${i}" class="modal">
                        <div class="modal-content">
                            <h4 class="center-align cyan-text text-darken-3">${datos.Title} (${datos.Year})</h4>
                            </br>
                            <div>
                                <label>
                                    <input type="checkbox" id="fav" name="fav"/>
                                    <span>Marcar com favorit</span>
                                </label>
                            </div>
                            <div id="formValue">
                                </br>
                                <h5 class="red-text darken-1">Valoració</h5>
                                </br>
                                <label>
                                    <input name="valoració" type="radio" value="1"/>
                                    <span>1</span>
                                </label>
                                <label>
                                    <input name="valoració" type="radio" value="2"/>
                                    <span>2</span>
                                </label>
                                <label>
                                    <input name="valoració" type="radio" value="3"/>
                                    <span>3</span>
                                </label>
                                <label>
                                    <input name="valoració" type="radio" value="4"/>
                                    <span>4</span>
                                </label>
                                <label>
                                    <input name="valoració" type="radio" value="5"/>
                                    <span>5</span>
                                </label>
                            </div>
                            <div class="input-field">
                                <textarea id="comentario" class="materialize-textarea" data-length="200"></textarea>
                                <label for="comentario">Comentari</label>
                            </div>
                            <button id="btn-guardar" class="btn waves-effect waves-light disabled"> Guardar </button>
                            <!--<div id="divError" class="divError"><label class="error"><span style="font-size: 20px"> ! </span>Debes de iniciar sesión para poder hacer una valoración</label></div>-->
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="btn modal-close red"><i class="material-icons">Tancar</i></a>
                        </div>
                    </div>
                 </div>`;
    }
    document.getElementById("items").innerHTML=pelis;
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems,{});
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