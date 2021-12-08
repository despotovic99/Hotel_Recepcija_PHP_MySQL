$('#pretraga').on("keyup", function() {
    let txtValue = $(this).val();
    let filter = txtValue.toLowerCase();
    let red = $("#tableBody")[0].getElementsByTagName("tr");

    for(let i=0;i<red.length;i++){

        let vidljiv=false;

        for(let j=0;j<red[i].getElementsByTagName("td").length;j++){
            let td = red[i].getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    vidljiv=true;
                }
            }
        }
        if(vidljiv){
            red[i].style.display = "";
        }else{
            red[i].style.display = "none";
        }
    }

});

$('#sortBtn').click(function (){

    let nizPomocni = $("#tableBody")[0].getElementsByTagName("tr");
    let niz =[];
    for(let i=0;i<nizPomocni.length;i++){
        niz.push(nizPomocni[i]);
    }
    $('#tableBody').empty();
    let sortiran = false;

    if($(this).val()!=='A-Z'){
        $(this).val('A-Z');

        while (!sortiran){
            sortiran=true;
            for(let i=1;i<niz.length;i++){

                let e1 =niz[i-1].getElementsByTagName('td')[0].innerHTML;
                let e2 =niz[i].getElementsByTagName('td')[0].innerHTML;

                if(e1>e2){
                    let p = niz[i-1];
                    niz[i-1]=niz[i];
                    niz[i]=p;
                    sortiran=false;
                    break;
                }
            }
        }

    }else{
        $(this).val('Z-A');
        while (!sortiran){
            sortiran=true;
            for(let i=1;i<niz.length;i++){

                let e1 =niz[i-1].getElementsByTagName('td')[0].innerHTML;
                let e2 =niz[i].getElementsByTagName('td')[0].innerHTML;

                if(e1<e2){
                    let p = niz[i-1];
                    niz[i-1]=niz[i];
                    niz[i]=p;
                    sortiran=false;
                    break;
                }
            }
        }
    }



    for (let i=0;i<niz.length;i++) {
        console.log(niz[i])
        $('#tableBody').append(niz[i]);
    }


});