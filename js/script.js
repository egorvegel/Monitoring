$(function(){
    let cells = $(".b-calendar__day");
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
        let month = date.getMonth();
        let numEq = $("select[name='type']").val();

        // Количество дней в последнем месяцу
        let manyDays = getDays(year, month);
        
        // Редактирую даты для отправки запроса
        let start = new Date(year, month, 1);
        let end = new Date(year, month+3, 1);


        let nullStartGetMonth = nullDate(start.getMonth());
        let nullEndGetMonth = nullDate(end.getMonth());

        let request = {
            "DateStart": start.getFullYear() + "-" + nullStartGetMonth + (start.getMonth()+1) + "-"+ "01T00:00:00",
            "DateEnd": end.getFullYear() + "-" + nullEndGetMonth + end.getMonth() + "-" + manyDays + "T00:00:00",
            "Equipment": Number(numEq),
        }

        setDate(new Date());
        
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
                // Данные приходят с серверс   
                let response = JSON.parse(request.responseText);
                // Окрашиваем ячейки
                responseHandler(response);  
                console.log(response);
            }

        }

        request.open("POST", "php/handler.php");
        request.send(data);
    }

    function responseHandler(response){
        let cells = $(".b-calendar__day");
        let d = 0;

        animToolTip(response);

        for(let i = 0; i < response.length; i++){
            let all = response[i].Total;
            let recorded = response[i].Recorded;
            let came = response[i].Came;
            let didNotCome = response[i].didNotCome;


            let day = response[d].Date.slice(8, -9);
            if(day.split("")[0] === "0"){
                day = day.split("")[1];
            }
            
            if(cells[i].textContent !== day){
                $(cells[i]).addClass("none");
            }else{
                d++;
                if(all < recorded || all < came){
                    $(cells[i]).addClass("active");
                }else{
                    $(cells[i]).addClass("nonactive");
                }
                                
                today();     
            } 

            function today(){
                let now = new Date();             
                if(now.getDate() == cells[i].textContent){
                    cells[i].classList.remove("active");
                    cells[i].classList.remove("nonactive");
    
                    $("#total").html(all);
                    $("#recorded").html(recorded);
                    $("#came").html(came);

                    came === 0 ? $("#came").html(0) : $("#came").html(came);
                    didNotCome === 0 ? $("#didNotCome").html(0) : $("#didNotCome").html(didNotCome);
                    today++;
                }    
            }
        }
    }

    function animToolTip(response){
        $(".b-calendar__day").on("mousemove", function(e){
            for(let d = 0; d < response.length; d++){
                let str = response[d].Date.slice(0, -9);
                
                if(str === this.dataset.date){
                    if(response[d].Recorded === "") response[d].Recorded = 0;
                    if(response[d].Came === "") response[d].Came = 0;

                    if(response[d].Total <= response[d].Recorded + response[d].Came){
                        $(".tooltip").html("Мест нету");
                    }else{
                        let dif = response[d].Total - response[d].Recorded;
                        $(".tooltip").html(`${dif} свободно`);
                    }
                }else{
                    d = d;
                }
            }
            $(".tooltip").css({
                top: this.getBoundingClientRect().top + pageYOffset - 42,
                left: this.getBoundingClientRect().left + pageXOffset - 38,
                opacity: 0.9,
            })
            
        })
    
        $(".b-calendar__day").on("mouseout", function(e){
            $(".tooltip").css({
                top: this.getBoundingClientRect().top + pageYOffset - 42,
                left: this.getBoundingClientRect().left + pageXOffset - 38,
                opacity: 0,
            }) 
        })
    }

    function nullDate(condition){
        let str = "";
        if(condition < 10){
            return str = "0";
        } 
        return str;
    } 
    
    function setDate(date){
        let allDays = 0;
        let count = 0;
        for(let m = 0; m < 3; m++){
            let monthTool = new Date(date.getFullYear(), date.getMonth() + m, 1);
            let DaysInMonth = new Date(date.getFullYear(), date.getMonth() + m + 1, 0).getDate();

            count += DaysInMonth;   
            nullStartGetMonth = nullDate(monthTool.getMonth());
            for(let j = allDays, c = 0; j < count; j++, c++){
                let str = monthTool.getFullYear() + "-" + nullStartGetMonth + (monthTool.getMonth() + 1) + "-" + nullDate(c + 1) + (c + 1);
                cells[j].dataset.date = str;
            }
            allDays += DaysInMonth;
        }      
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
})



