function cekMember() {
    var formData = new FormData();
    formData.append('id', $('#member_id').val());
    $.ajax({
        url: 'http://localhost:8080/members/find',
        type: 'POST',
        data: formData,
        success: function (data) {
          console.log(data);
          if (data=="tidak ditemukan"){
            alert("nis tidak ditemukan");
            $('#sbmtbtn').addClass("disabled");
            $('#sbmtbtn').attr('type','button');
          }
          else if (data=="anda sudah daftar silahkan login"){
            alert(data);
            $('#sbmtbtn').addClass("disabled");
            $('#sbmtbtn').attr('type','button');
          }
          else{
            $('#sbmtbtn').attr('type','submit');
            $('#sbmtbtn').removeClass('disabled');
            $('#sbmtbtn').attr('type','submit');
            const myArray = data.split(" ");
            console.log(myArray)
            let word = myArray[0];
            $("#firstname").val(word);
            var lastword=""
            for (i in myArray){
              if(i==0){}
              else if(i==myArray.length){lastword+=String(myArray[i])}
              else{ lastword+= String(myArray[i])+" ";}
            }
            $("#lastname").val(lastword);
          }
          },
        cache: false,
        contentType: false,
        processData: false
    });
}

function cekBuku() {
    var formData = new FormData();
    formData.append('ISBN', $('#ISBN').val());
    $.ajax({
        url: 'http://localhost:8080/katalog/find',
        type: 'POST',
        data: formData,
        success: function (data) {
          var asd = JSON.parse(data);
          $('#judul').val(asd[0]);
          $('#book_id').val(asd[1]);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}