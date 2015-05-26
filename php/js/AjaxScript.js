function provjeri()
{
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function () {


	    if (ajax.readyState == 4 && ajax.status == 200) {
	        var arr = JSON.parse(ajax.response);

	        if (arr.ok == "Mjesto je iz date općine") {
	            ProvjeriJeLiUneseno(true, true);
	        }
	        else if(arr.greska != "Nepostojeće mjesto"){
                ProvjeriJeLiUneseno(true, false)
	        }
            else if(arr.greska != "Nepostojeća općina"){
                ProvjeriJeLiUneseno(false, false)
	        }


	    }
	    if (ajax.readyState == 4 && ajax.status == 404) {
	        alert("Pogrešan URL za web servis!");
	    }

	}

	    var mjesto = document.getElementById("mjesto").value;
		mjesto = encodeURIComponent(mjesto);

        var opcina = document.getElementById("opcina").value;
		opcina = encodeURIComponent(opcina);

	    ajax.open("GET", "http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=" + opcina + "&mjesto=" + mjesto, true);
	    ajax.send();
	    return false;
}


function prikazi(adresa)
{
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function () {
	    console.log(ajax.responseText);
	    if (ajax.readyState == 4 && ajax.status == 200) {
	        document.getElementById("GlavniDio").innerHTML = ajax.responseText;
	    }
	    if (ajax.readyState == 4 && ajax.status == 404)
	        document.getElementById("GlavniDio").innerHTML = "Greska: nepoznat URL";
	}
	    ajax.open("GET", adresa, true);
	    ajax.send();
	    return false;
}