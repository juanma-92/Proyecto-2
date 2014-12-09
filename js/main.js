window.addEventListener("load", function() {
    var borrar = document.getElementsByClassName("borrar");
    for (var i = 0; i < borrar.length; i++) {
        borrar[i].addEventListener("click", confirmar);
    }

    var editar = document.getElementsByClassName("editar");
    for (var i = 0; i < editar.length; i++) {
        editar[i].addEventListener("click", modificar);
    }

    /* function confirmar(e){                
        //if(!confirm("¿Quieres borrar a "+ e.currentTarget.getAttribute("data-nombre") +"?")){
        if(!confirm("¿Quieres borrar a "+ this.getAttribute("data-nombre") +"?")){
            e.preventDefault();
        }        
     }
     */

    function confirmar(e) {
        e.preventDefault();  
        if(confirm("¿Quieres borrar a "+ this.getAttribute("data-nombre") +"?")){
            var id = this.getAttribute("data-id");
            var f = document.getElementById("formulario");
            f.action = "phpDelete.php";
            var idf = document.getElementById("idformulario");
            idf.value = id;
            f.submit();
        }
    }

    function modificar(e) {
        e.preventDefault();
        var id = this.getAttribute("data-id");
        var f = document.getElementById("formulario");
        f.action = "ver.php";
        var idf = document.getElementById("idformulario");
        idf.value = id;
        f.submit();
    }
})