$("#formaRezervacija").submit(function(){
    event.preventDefault();

    const forma = $(this);
    let unos = forma.find('input, select');

    const podaci = unos.serialize();
    console.log(podaci);
    unos.prop('disabled',true);
    let url ="operations/rezervacija/dodaj.php";
    if($('input[name="sifra"]')[0].value!=""){
        url="operations/rezervacija/azuriraj.php";
    }

    req=$.ajax({
        url:url,
        method:'post',
        data:podaci
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno sacuvana rezervacija" || res=="Uspesno azurirana rezervacija"){
            $('<div class="container" style="color: green;"><h5>Rezervacija uspešno sačuvana</h5></div>').insertBefore($('#hotelskaSobaDivId')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else{
            $('<div class="container" style="color: red;"><h5>Rezervacija neuspešno sačuvana</h5></div>').insertBefore($('#hotelskaSobaDivId')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }
    });

    req.fail(function(jqXHR,textStatus,errorThrown){
        alert("Greska: ",textStatus,errorThrown);
    });
    unos.prop('disabled',false);
});

$('#resetForme').click(function (){
    $('input[name="sifra"]').val("");
});

$('input[name="checkRezervacija"]').click(function(){
    let sifraRez = $('input[name="checkRezervacija"]:checked')[0].value;

    $('input[name="sifra"]')[0].value=sifraRez;

    req=$.ajax({
        url:"operations/rezervacija/vrati.php",
        method:'post',
        data:{"sifra":sifraRez}
    });
    req.done(function (res,textStatus,jqXHR){
        let odg=$.parseJSON(res);
        $('#sifraHotelskeSobeId').val(odg.sifraHotelskeSobe);
        $('#sifraGostaId').val(odg.sifraGosta);
        $('#datumOdId').val(odg.datumOd);
        $('#datumDoId').val(odg.datumDo);
        $('input[name="cena"]')[0].value=odg.cena;
    });
});

$('#obrisi').click(function(){
    event.preventDefault();

    if($('input[name="sifra"]')[0].value==undefined || $('input[name="sifra"]')[0].value==""){
        $('<div class="container" style="color: red;"><h5>Rezervacija nije odabrana</h5></div>').insertBefore($('#hotelskaSobaDivId')).delay(3000).fadeOut(function() {
            $(this).remove();
        });
        return;
    }

    req=$.ajax({
        url:"operations/rezervacija/obrisi.php",
        method:'post',
        data:{'sifra':$('input[name="sifra"]')[0].value}
    });

    console.log($('input[name="sifra"]')[0].value);

    req.done(function(res,textStatus,jqXHR){
        if(res==="Uspesno obrisana rezervacija"){
            $('<div style="color: green;"><h5>Uspesno obrisana rezervacija</h5></div>').insertBefore($('#hotelskaSobaDivId')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else if(res==='Neuspesno obrisana rezervacija'){
            $('<div style="color: red;"><h5>Nespesno obrisana rezervacija</h5></div>').insertBefore($('#hotelskaSobaDivId')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }else {
            $('<div style="color: red;"><h5>Nespesno, nema šifre rezervacije</h5></div>').insertBefore($('#hotelskaSobaDivId')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }

    });
});

