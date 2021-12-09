$('#formaHotel').submit(function (){
    event.preventDefault();
    const forma = $(this);
    const unos = forma.find('input, select');
    const podaci = forma.serialize();
    console.log(podaci);
    unos.prop("disabled",true);
    let url = "operations/hotel/dodaj.php";
    if($('input[name="sifra"]')[0].value!=""){
       url="operations/hotel/azuriraj.php";
    }
    req=$.ajax({
        url: url,
        method:"post",
        data:podaci
    });

    req.done(function(res,textStatus,jqXHR){
        if(res==="Uspesno sacuvan hotel" || res==="Uspesno azuriran hotel"){
            $('<div style="color: green;"><h5>Uspesno sacuvan hotel</h5></div>').insertBefore($('#nazivHotelaDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else{
            $('<div style="color: red;"><h5>Neuspesno sacuvan hotel</h5></div>').insertBefore($('#nazivHotelaDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }
    });

    req.fail(function(jqXHR,textStatus,errorThrown){
        alert("Greska: ",textStatus,errorThrown);
    });
    unos.prop('disabled',false);
});

$('input[name="checkHotel"]').click(function (){

    const odabrani = $('input[name="checkHotel"]:checked');

    console.log("Odabran hotel "+ odabrani.val());

    req=$.ajax({
        url:'operations/hotel/vrati.php',
        method:'post',
        data:{'sifra':odabrani.val()}
    });

    req.done(function(res,textStatus,jqXHR){
        let odg = $.parseJSON(res);
        console.log(odg);
        $('input[name="sifra"]').val(odg.sifra);
        $('input[name="naziv"]').val(odg.naziv);
        $('input[name="adresa"]').val(odg.adresa);

        const brZvezdica=odg.brojZvezdica;

        $('select').val(brZvezdica);



    });
});

$('#resetForme').click(function (){
    $('input[name="sifra"]').val("");
    $('input[name="checkHotel"]').prop('checked',false);

    $('select').val(0);
    console.log($('option')[0])
});

$('#obrisi').click(function(e){
    e.preventDefault();
    if($('input[name="sifra"]')[0].value==undefined || $('input[name="sifra"]')[0].value==""){
        $('<div class="container" style="color: red;"><h5>Hotel nije odabran</h5></div>').insertBefore($('#nazivHotelaDiv')).delay(3000).fadeOut(function() {
            $(this).remove();
        });
        return;
    }

    req=$.ajax({
        url:"operations/hotel/obrisi.php",
        method:'post',
        data:{'sifra':$('input[name="sifra"]')[0].value}
    });

    console.log($('input[name="sifra"]')[0].value);

    req.done(function(res,textStatus,jqXHR){
        if(res==="Uspesno obrisan hotel"){
            $('<div style="color: green;"><h5>Uspesno obrisan hotel</h5></div>').insertBefore($('#nazivHotelaDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else if(res==='Neuspesno obrisan hotel'){
            $('<div style="color: red;"><h5>Nespesno obrisan hotel</h5></div>').insertBefore($('#nazivHotelaDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }else {
            $('<div style="color: red;"><h5>Nespesno, nema šifre hotela</h5></div>').insertBefore($('#nazivHotelaDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }

    });


});