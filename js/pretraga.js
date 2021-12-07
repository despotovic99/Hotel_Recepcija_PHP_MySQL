$('#pretraga').on("keyup", function() {
    var txtValue = $(this).val();
    var filter = txtValue.toLowerCase();
    let tr = $("#tableBodyRezervacija")[0].getElementsByTagName("tr");

    for(let i=0;i<tr.length;i++){

        let vidljiv=false;

        for(let j=0;j<tr[i].getElementsByTagName("td").length;j++){
            let td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    vidljiv=true;
                }
            }

        }
        if(vidljiv){
            tr[i].style.display = "";
        }else{
            tr[i].style.display = "none";
        }
    }

});