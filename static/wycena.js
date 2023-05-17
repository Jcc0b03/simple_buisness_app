const cennik = {
    graficzny: 500,
    podstrony: 50,
    cms_true: 1200,
    cms_false: 600,
    ekspres: 1.2,
    seo: 600
}
let projekt = {
    graficzny: false,
    podstrony: 0,
    cms: false,
    ekspres: false,
    seo: false,
    cena: 0
}
const button = document.getElementById("submit");
button.onclick = () => {projekt.cena = 0;
                        projekt.graficzny=document.getElementById("graficzny").checked;
                        projekt.podstrony=document.getElementById("podstrony").value;
                        projekt.cms=document.getElementById("CMS").checked;
                        projekt.ekspres=document.getElementById("ekspres").checked;
                        projekt.seo=document.getElementById("SEO").checked;
                        
                        projekt.graficzny ? projekt.cena+=cennik.graficzny : null;
                        projekt.podstrony != 0 ? projekt.cena+=(projekt.podstrony*cennik.podstrony) : null;
                        projekt.cms ? projekt.cena += cennik.cms_true : projekt.cena += cennik.cms_false;
                        projekt.seo ? projekt.cena += cennik.seo : null
                        projekt.ekspres ? projekt.cena *= cennik.ekspres : null;
                        
                        const wycena_p = document.getElementById("wycena");
                        wycena_p.parentElement.style.display = "block";
                        wycena_p.innerHTML = null;
                        wycena_p.innerHTML="Wycena twojego projektu: "+projekt.cena+"zł";}