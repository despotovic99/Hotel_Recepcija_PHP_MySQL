$('#formaGost').submit(function(){
    event.preventDefault();
    const forma=$(this);
    const unos=forma.find('input');
    console.log(unos)
    let podaci=forma.serialize();
    podaci+=`&pol=${$('input[name="pol"]:checked').val()}`;
    podaci+=`&straniGost=${$('input[name="straniGost"]:checked').val()}`;

    console.log(podaci);
    unos.prop('disabled',true);
    let url = "operations/gost/dodaj.php";
    if($("input[name='sifra']")[0].value!=""){
        url="operations/gost/azuriraj.php";
    }
    req=$.ajax({
        url:url,
        method:"post",
        data:podaci
    });

    req.done(function(res,textStatus,jqXHR){
        if(res==="Uspesno sacuvan gost" || res==="Uspesno azuriran gost"){
            $('<div style="color: green;"><h5>Uspesno sacuvan gost</h5></div>').insertBefore($('#brD')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else{
            $('<div style="color: red;"><h5>Neuspesno sacuvan gost</h5></div>').insertBefore($('#brD')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }
    });

    req.fail(function(jqXHR,textStatus,errorThrown){
        alert("Greska: ",textStatus,errorThrown);
    });
    unos.prop('disabled',false);
});

$('input[name="checkGost"]').click(function (){

    const odabrani = $('input[name="checkGost"]:checked');

    console.log("Odabran gost "+ odabrani.val());

    req=$.ajax({
        url:'operations/gost/vrati.php',
        method:'post',
        data:{'sifra':odabrani.val()}
    });

    req.done(function(res,textStatus,jqXHR){
        let odg = $.parseJSON(res);

       $('input[name="sifra"]').val(odg[0].sifra);
       $('input[name="brDokumenta"]').val(odg[0].brDokumenta);
       $('input[name="ime"]').val(odg[0].ime);
       $('input[name="prezime"]').val(odg[0].prezime);
       $('input[name="datumRodjenja"]').val(odg[0].datumRodjenja);
       $('input[name="email"]').val(odg[0].email);
       $('input[name="brTelefona"]').val(odg[0].brTelefona);
       if(odg[0].pol=='Z'||odg[0].pol=='z'){
           $('#radioZ').prop('checked',true);
       }else{
           $('#radioM').prop('checked',true);
       }
        $('#checkStrani').prop("checked",false);
       if(odg[0].straniGost==1){
           $('#checkStrani').prop("checked",true);
       }


    });
});

$('#resetForme').click(function (){
    $('input[name="sifra"]').val("");
    $('input[name="checkGost"]:checked').prop('checked',false);
});

$('#obrisi').click(function(e){
    e.preventDefault();
    if($('input[name="sifra"]')[0].value==undefined || $('input[name="sifra"]')[0].value==""){
        $('<div class="container" style="color: red;"><h5>Gost nije odabran</h5></div>').insertBefore($('#brD')).delay(3000).fadeOut(function() {
            $(this).remove();
        });
        return;
    }

    req=$.ajax({
        url:"operations/gost/obrisi.php",
        method:'post',
        data:{'sifra':$('input[name="sifra"]')[0].value}
    });

    console.log($('input[name="sifra"]')[0].value);

    req.done(function(res,textStatus,jqXHR){
        if(res==="Uspesno obrisan gost"){
            $('<div style="color: green;"><h5>Uspesno obrisan gost</h5></div>').insertBefore($('#brD')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
            location.reload();
        }else if(res==='Neuspesno obrisan gost'){
            $('<div style="color: red;"><h5>Nespesno obrisan gost</h5></div>').insertBefore($('#brD')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }else {
            $('<div style="color: red;"><h5>Nespesno, nema šifre gosta</h5></div>').insertBefore($('#brD')).delay(3000).fadeOut(function() {
                $(this).remove();
            });
        }

    });


});