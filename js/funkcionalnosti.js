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

    let tabela = document.getElementById("tableBody");

    let sortiran = false;

    if($(this).val()!=='A-Z'){
        $(this).val('A-Z');

        while (!sortiran) {
            sortiran = true;
            let tr = tabela.getElementsByTagName("tr");
            let zameniti;
            let i;
            for (i = 0; i < tr.length-1; i++) {
                zameniti = false;
                let el1 = tr[i].getElementsByTagName("td")[0];
                let el2 = tr[i + 1].getElementsByTagName("td")[0];
                if (el1.innerHTML.toLowerCase() > el2.innerHTML.toLowerCase()) {
                    zameniti = true;
                    break;
                }
            }
            if (zameniti) {
                tr[i].parentNode.insertBefore(tr[i + 1], tr[i]);
                sortiran = false;
            }
        }


    }else {
        $(this).val('Z-A');

        while (!sortiran) {
            sortiran = true;
            let tr = tabela.getElementsByTagName("tr");
            let zameniti;
            let i;
            for (i = 0; i < tr.length-1; i++) {
                zameniti = false;
                let el1 = tr[i].getElementsByTagName("td")[0];
                let el2 = tr[i + 1].getElementsByTagName("td")[0];
                if (el1.innerHTML.toLowerCase() < el2.innerHTML.toLowerCase()) {
                    zameniti = true;
                    break;
                }
            }
            if (zameniti) {
                tr[i].parentNode.insertBefore(tr[i + 1], tr[i]);
                sortiran = false;
            }
        }
    }
});