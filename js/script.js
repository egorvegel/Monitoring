$(function(){
    let data = getData();
    ajax(data);
    let arrTooltip = document.getElementsByClassName("nonactive");
    $("select[name='hospital']").on("change", function(){
        let data = getData();
        ajax(data);
    })

    $("select[name='type']").on("change", function(){
        let data = getData();
        ajax(data);
    })

    function getData(){
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();// November
        let numEq = $("select[name='type']").val();

        // Количество дней в последнем месяцу
        let manyDays = getDays(year, month);
        
        // Редактирую даты для отправки запроса
        let start = new Date(year, month, 1);
        let end = new Date(year, month+3, 1);

        let request = {
            "DateStart": start.getFullYear() + "-" + start.getMonth() + "-"+ "01T00:00:00",
            "DateEnd": end.getFullYear() + "-" + end.getMonth() + "-" + manyDays + "T00:00:00",
            "Equipment": numEq,
        }
        return JSON.stringify(request);
    }

    function getDays(year, month){
        let date1 = new Date(year, month+2, 1);
        let date2 = new Date(year, month+3, 1);
        let date3 = Math.round((date2 - date1) / 1000 / 3600 / 24);
        return date3;
    }

    function ajax(data){
        let request = new XMLHttpRequest();
        
        request.onreadystatechange = function(){     
            if(request.readyState == 4){
                // Даннаые приходят с серверс
                let response = JSON.parse(request.responseText);
                console.log(response);
                // Окрашиваем ячейки
                responseHandler(response);
            }
        }

        request.open("POST", "php/handler.php");
        //request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //Чтобы браузер передал вместе с запросом куки и HTTP-авторизацию
        xhr.withCredentials = true;

        // btoa -> Предназаначен для кодирования строки
        request.setRequestHeader("Authorization", 'Basic ' + btoa('Ctmri:ZxCv'));
        
        request.send(data);
    }

    function responseHandler(response){
        let cells = $(".b-calendar__day");
        
        for(let i = 0; i < response.length; i++){

            let all = response[i].Total;
            let recorded = response[i].Recorded;
            let came = response[i].Came;
            let didNotCome = response[i].didNotCome;
            
            if(all == recorded + came){
                $(cells[i]).addClass("active");
            }else{
                $(cells[i]).addClass("nonactive");
            }
            
            //Сегодняшний день
            let now = new Date();
            if(now.getDate() == cells[i].textContent){
                cells[i].classList.remove("active");
                cells[i].classList.remove("nonactive");
                $("#total").html(all);
                $("#recorded").html(recorded);
                $("#came").html(came);

                $("#didNotCome").html("0");
                if(didNotCome != ""){
                    $("#didNotCome").html(didNotCome);
                }
            }
        }
        toolTip(response);  
    }


    // Анимация у select
    $("body").on("click", function(e){
        let target = e.target;
        if(target.tagName == "SELECT"){
            $($(target).parent(".item__select")[0]).addClass("clicked");
        }else{
            $(".item__select").removeClass("clicked");
        }
    })
    // tooltip
    function toolTip(response){
        arrTooltip = document.getElementsByClassName("nonactive");
        
        for(let i = 0; i < arrTooltip.length; i++){
            arrTooltip[i].addEventListener("mouseenter",function(){
                // Вписывает число в подсказку
                textTooltip(response, i, this);

                $(".tooltip").css({
                    top: this.getBoundingClientRect().top + pageYOffset - 42,
                    left: this.getBoundingClientRect().left + pageXOffset - 38,
                    opacity: 0.9,
                })
            })
            arrTooltip[i].addEventListener("mouseleave", function(){
                // Вписывает число в подсказку
                textTooltip(response, i, this);
                $(".tooltip").css({
                    top: this.getBoundingClientRect().top + pageYOffset - 42,
                    left: this.getBoundingClientRect().left + pageXOffset - 38,
                    opacity: 0,
                })
            })
        }
    }
    
    function textTooltip(response, index, self){
        let data = response[index].Date.split("-");
        let num = self.textContent;
        data[2] = num + "T00:00:00";

        data = data.join("-");

        for(let k = 0; k < response.length; k++){
            if(response[k].Date == data){
                let txt = response[k].Total - response[k].Recorded + " свободно";
                $(".tooltip").html(txt);
            }
        }
       
    }
})
