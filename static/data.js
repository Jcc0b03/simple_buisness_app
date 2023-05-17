dzis = new Date;
        data = ('0' + dzis.getDate()).slice(-2) + '.'+
                       ('0' + (dzis.getMonth()+1)).slice(-2) + '.'+
                       dzis.getFullYear();
        data_span = document.getElementById("date-span");
        data_span.innerHTML += String(data);