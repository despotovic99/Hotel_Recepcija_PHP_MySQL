$('input[name="checkHotelskaSoba"]').click(function (){
    const soba = $('input[name="checkHotelskaSoba"]:checked');
    console.log("Izabrana soba ",soba.val());

    req=$.ajax({
        url:'operations/hotelskasoba/vrati.php',
        method:'post',
        data:{'sifra':soba.val()}
    });

    req.done(function(res,textStatus,jqXHR){
        let odg = $.parseJSON(res);
        console.log(odg);
        $('input[name="sifra"]').val(odg.sifra);
        $('input[name="broj"]').val(odg.broj);
        $('input[name="sprat"]').val(odg.sprat);
        $('input[name="brojKreveta"]').val(odg.brojKreveta);
        $('#checkKuhinja').prop("checked",false);
        $('#checkTerasa').prop("checked",false);
        $('#checkMinibar').prop("checked",false);
        if(odg.kuhinja==1){
            $('#checkKuhinja').prop("checked",true);
        }
        if(odg.terasa==1){
            $('#checkTerasa').prop("checked",true);
        }
        if(odg.minibar==1){
            $('#checkMinibar').prop("checked",true);
        }
        $('select').val(odg.sifraHotela);
    });

});

$('#resetForme').click(function (){
    $('input[name="sifra"]').val("");
    $('#checkKuhinja').prop("checked",false);
    $('#checkTerasa').prop("checked",false);
    $('#checkMinibar').prop("checked",false);
});

$('#formaSoba').submit(function (){
    event.preventDefault();
    const forma = $(this);
    const unos = forma.find('select');
    unos.prop('disabled',true);
    let podaci="";
    let sifra=$('input[name="sifra"]').val()
    podaci+=`&sifra=${sifra}`;
    let broj=$('input[name="broj"]').val()
    podaci+=`&broj=${broj}`;
    let sprat=$('input[name="sprat"]').val();
    podaci+=`&sprat=${sprat}`;
    let brojKreveta=$('input[name="brojKreveta"]').val();
    podaci+=`&brojKreveta=${brojKreveta}`;
    let hotel=$('#sifraHotelaId').find(':selected').val();
    podaci+=`&sifraHotela=${hotel}`;

    let kuhinjaVrednost= $('#checkKuhinja').is(":checked")?1:0;
    let terasaVrednost= $('#checkTerasa').is(":checked")?1:0;
    let minibarVrednost= $('#checkMinibar').is(":checked")?1:0;
    podaci+=`&kuhinja=${kuhinjaVrednost}&terasa=${terasaVrednost}&minibar=${minibarVrednost}`;
    console.log(podaci);
    let url = 'operations/hotelskasoba/dodaj.php';
    if($('input[name="sifra"]')[0].value!=""){
        url = 'operations/hotelskasoba/azuriraj.php';

    }
    req=$.ajax({
        url: url,
        method:'post',
        data: podaci
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno sacuvana hotelska soba" ||res=="Uspesno azurirana hotelska soba"){
            $('<div style="color: green;"><h5>Uspesno sacuvana soba</h5></div>').insertBefore($('#nazivHotelskeSobeDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else{
            $('<div style="color: red;"><h5>Neuspesno sacuvana soba</h5></div>').insertBefore($('#nazivHotelskeSobeDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }
    });

    req.fail(function(jqXHR,textStatus,errorThrown){
        alert("Greska: ",textStatus,errorThrown);
    });

    unos.prop('disabled',false);
});

$('#obrisi').click(function(e){
    e.preventDefault();
    if($('input[name="sifra"]')[0].value==undefined || $('input[name="sifra"]')[0].value==""){
        $('<div class="container" style="color: red;"><h5>Soba nije odabrana</h5></div>').insertBefore($('#nazivHotelskeSobeDiv')).delay(3000).fadeOut(function() {
            $(this).remove();
        });
        return;
    }

    req=$.ajax({
        url:"operations/hotelskasoba/obrisi.php",
        method:'post',
        data:{'sifra':$('input[name="sifra"]')[0].value}
    });

    console.log($('input[name="sifra"]')[0].value);

    req.done(function(res,textStatus,jqXHR){
        if(res==="Uspesno obrisana hotelska soba"){
            $('<div style="color: green;"><h5>Uspesno obrisana soba</h5></div>').insertBefore($('#nazivHotelskeSobeDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else if(res==='Neuspesno obrisana hotelska soba'){
            $('<div style="color: red;"><h5>Nespesno obrisana soba</h5></div>').insertBefore($('#nazivHotelskeSobeDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }else {
            $('<div style="color: red;"><h5>Nespesno, nema šifre sobe</h5></div>').insertBefore($('#nazivHotelskeSobeDiv')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }

    });


});