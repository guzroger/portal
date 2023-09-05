function directoryFind(quantity){
    searchBox = document.getElementById("searchBox");    

    search = searchBox.value.toUpperCase();

    for (i = 1; i < quantity; i++) {
        searchName = document.getElementById("searchName" + i).value.toUpperCase();

        searchItem = document.getElementById("searchItem" + i).value.toUpperCase();

        searchArea = document.getElementById("searchArea" + i).value.toUpperCase();

        if (searchName.indexOf(search) > -1 || searchItem.indexOf(search) > -1 || searchArea.indexOf(search) > -1 ) {
            document.getElementById("personal" + i).style.display = "";
        } else {
            document.getElementById("personal" + i).style.display = "none";
        }
    }
}

function selectPersonal(selected){

    if (selected == 'all'){
        var uno = document.getElementsByClassName("connected");
        var dos = document.getElementsByClassName("disconnected");
        var tres = document.getElementsByClassName("noactive");
        var cuatro = document.getElementsByClassName("inactive");

        for (a = 0; a < uno.length; a++) {
            uno[a].style.display = 'block';
        }

        for (b = 0; b < dos.length; b++) {
            dos[b].style.display = 'block';
        }

        for (c = 0; c < tres.length; c++) {
            tres[c].style.display = 'block';
        }

        for (d = 0; d < cuatro.length; d++) {
            cuatro[d].style.display = 'block';
        }

        document.getElementById("all").className = "current";
        document.getElementById("connected").className = "";
        document.getElementById("disconnected").className = "";
        document.getElementById("noactive").className = "";
        document.getElementById("inactive").className = "";

    }else if(selected == 'connected'){
    
        var uno = document.getElementsByClassName("connected");
        var dos = document.getElementsByClassName("disconnected");
        var tres = document.getElementsByClassName("noactive");
        var cuatro = document.getElementsByClassName("inactive");

        for (a = 0; a < uno.length; a++) {
            uno[a].style.display = 'block';
        }

        for (b = 0; b < dos.length; b++) {
            dos[b].style.display = 'none';
        }

        for (c = 0; c < tres.length; c++) {
            tres[c].style.display = 'none';
        }

        for (d = 0; d < cuatro.length; d++) {
            cuatro[d].style.display = 'none';
        }

        document.getElementById("all").className = "";
        document.getElementById("connected").className = "current";
        document.getElementById("disconnected").className = "";
        document.getElementById("noactive").className = "";
        document.getElementById("inactive").className = "";

    }else if(selected == 'disconnected'){
    
        var uno = document.getElementsByClassName("connected");
        var dos = document.getElementsByClassName("disconnected");
        var tres = document.getElementsByClassName("noactive");
        var cuatro = document.getElementsByClassName("inactive");

        for (a = 0; a < uno.length; a++) {
            uno[a].style.display = 'none';
        }

        for (b = 0; b < dos.length; b++) {
            dos[b].style.display = 'block';
        }

        for (c = 0; c < tres.length; c++) {
            tres[c].style.display = 'none';
        }

        for (d = 0; d < cuatro.length; d++) {
            cuatro[d].style.display = 'none';
        }

        document.getElementById("all").className = "";
        document.getElementById("connected").className = "";
        document.getElementById("disconnected").className = "current";
        document.getElementById("noactive").className = "";
        document.getElementById("inactive").className = "";

    }else if(selected == 'noactive'){
    
        var uno = document.getElementsByClassName("connected");
        var dos = document.getElementsByClassName("disconnected");
        var tres = document.getElementsByClassName("noactive");
        var cuatro = document.getElementsByClassName("inactive");

        for (a = 0; a < uno.length; a++) {
            uno[a].style.display = 'none';
        }

        for (b = 0; b < dos.length; b++) {
            dos[b].style.display = 'none';
        }

        for (c = 0; c < tres.length; c++) {
            tres[c].style.display = 'block';
        }

        for (d = 0; d < cuatro.length; d++) {
            cuatro[d].style.display = 'none';
        }

        document.getElementById("all").className = "";
        document.getElementById("connected").className = "";
        document.getElementById("disconnected").className = "";
        document.getElementById("noactive").className = "current";
        document.getElementById("inactive").className = "";

    }else if(selected == 'inactive'){
    
        var uno = document.getElementsByClassName("connected");
        var dos = document.getElementsByClassName("disconnected");
        var tres = document.getElementsByClassName("noactive");
        var cuatro = document.getElementsByClassName("inactive");

        for (a = 0; a < uno.length; a++) {
            uno[a].style.display = 'none';
        }

        for (b = 0; b < dos.length; b++) {
            dos[b].style.display = 'none';
        }

        for (c = 0; c < tres.length; c++) {
            tres[c].style.display = 'none';
        }

        for (d = 0; d < cuatro.length; d++) {
            cuatro[d].style.display = 'block';
        }

        document.getElementById("all").className = "";
        document.getElementById("connected").className = "";
        document.getElementById("disconnected").className = "";
        document.getElementById("noactive").className = "";
        document.getElementById("inactive").className = "current";

    }
}

function selectLicense(selected){

    if (selected == 'allCheck'){
        var unoLic = document.getElementsByClassName("licenseYes");
        var dosLic = document.getElementsByClassName("licenseNo");

        for (a = 0; a < unoLic.length; a++) {
            unoLic[a].style.display = 'block';
        }

        for (b = 0; b < dosLic.length; b++) {
            dosLic[b].style.display = 'block';
        }

    }else if(selected == 'sinCheck'){

        var unoLic = document.getElementsByClassName("licenseYes");
        var dosLic = document.getElementsByClassName("licenseNo");

        for (a = 0; a < unoLic.length; a++) {
            unoLic[a].style.display = 'none';
        }

        for (b = 0; b < dosLic.length; b++) {
            dosLic[b].style.display = 'block';
        }

    }else if(selected == 'conCheck'){
    
        var unoLic = document.getElementsByClassName("licenseYes");
        var dosLic = document.getElementsByClassName("licenseNo");

        for (a = 0; a < unoLic.length; a++) {
            unoLic[a].style.display = 'block';
        }

        for (b = 0; b < dosLic.length; b++) {
            dosLic[b].style.display = 'none';
        }

    }
}