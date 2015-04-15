function prikazipodmeni(ref)
{
    var podmeni2 = document.getElementById('podmeni');
    var servis = document.getElementById('servis_li');

    if(podmeni2.style.visibility == "visible")
    {
        servis.style.fontSize = "12pt";
        servis.style.fontStyle="Normal";
        servis.style.fontWeight="400";
        servis.style.backgroundColor = "black";
        podmeni2.style.visibility = "hidden"; 
        podmeni2.style.fontSize = "12pt";
        podmeni2.style.fontStyle="Normal";
        podmeni2.style.fontWeight="400";
    }
    else
    {
        servis.style.fontWeight="700";
        servis.style.fontSize = "15pt";
        servis.style.backgroundColor = "#f7e90c";
        podmeni2.style.visibility = "visible";
        podmeni2.fontSize="12pt";
        podmeni2.style.fontStyle="Normal";
        podmeni2.style.fontWeight="400";     
    }

}
