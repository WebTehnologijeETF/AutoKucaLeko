function ProvjeriJeLiUneseno(mjesto,opcina)
{
      var forma = document.forms["Forma1"];
      var unesenoime, unesenoprezime, unesentelefon, unesenomjesto, unesenaopcina;

      if(forma.ime.value =="" ||  forma.ime.value.length<2)
      {
          forma.ime.style.color = "red";
          forma.ime.style.border = "1px solid red";
          unesenoime = false;
      }
      else
      {
          forma.ime.style.border = "1px solid black";
          forma.ime.style.color = "black";
          unesenoime = true;
      }

      if(forma.prezime.value=="" || forma.prezime.value.length<3)
      {
          forma.prezime.style.color = "red";
          forma.prezime.style.border = "1px solid red";
          unesenoprezime = false;
      }
      else
      {
          forma.prezime.style.border = "1px solid black";
          forma.prezime.style.color = "black";
          unesenoprezime = true;
      }

      if(mjesto==false)
      {
          forma.mjesto.style.color = "red";
          forma.mjesto.style.border = "1px solid red";
          unesenomjesto = false;
      }
      else
      {
          forma.mjesto.style.border = "1px solid black";
          forma.mjesto.style.color = "black";
          unesenomjesto = true;
      }

      if(opcina== false)
      {
          forma.opcina.style.color = "red";
          forma.opcina.style.border = "1px solid red";
          unesenaopcina = false;
      }
      else
      {
          forma.opcina.style.border = "1px solid black";
          forma.opcina.style.color = "black";
          unesenaopcina = true;
      }

      var regex = /^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/gm;

      if(forma.telefon.value=="" || forma.telefon.value.length<9 || regex.test(forma.telefon.value)==false)
      {
          forma.telefon.style.border = "1px solid red";
          forma.telefon.style.color = "red";
          unesentelefon = false;
      }
      else
      {
          forma.telefon.style.border = "1px solid black";
          forma.telefon.style.color = "black";
          unesentelefon = true;
      }


      if (unesenoime == false || unesenoprezime == false || unesentelefon == false || unesenaopcina == false || unesenomjesto == false) 
      {
          alert("Imate grešaka u unosu, popravite prije nego Vam omogućimo slanje! \nIme mora sadržavati najmanje 2 slova! \nPrezime mora sadržavati najmanje 3 slova! \nTelefon mora biti ispravan! \nMjesto mora pripadati općini! \nOpćina mora postojati!");
          return false;
      }
      else {
          alert("Uspješno ste poslali poruku!");
          return true;
      }
}


function TestirajSadrzajMail()
{
      var regex = /^.+@[^\.].*\.[a-z]{2,}$/gm;
      var forma = document.forms["Forma2"];

      if (regex.test(forma.email.value)) {
          return true;
      }
      else return false;
}
