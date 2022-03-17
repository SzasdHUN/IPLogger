function load(){
fetch("./list.json")
  .then(response => response.json())
  .then(json => {
      for(let i = 1; Object.keys(json["data"]).length + 1 > i; i++){

        var j = i - 1;
        var cL = document.createElement("div");
        cL.classList.add("list__element");
        document.getElementById("list").appendChild(cL);

        var order = document.createElement("span");
        order.classList.add("order");
        order.innerHTML = `${i}.`;
        cL.appendChild(order);

        {
          var openBacket = document.createElement("span");
          openBacket.innerHTML = "[ ";
          openBacket.classList.add("time__sep");
          cL.appendChild(openBacket);

          var ymd = document.createElement("span");
          ymd.innerHTML = `${json["data"][j]["ymd"]}`;                  
          ymd.classList.add("ymd");
          cL.appendChild(ymd);

          var middleDot = document.createElement("span");
          middleDot.innerHTML = " | ";
          middleDot.classList.add("time__sep");
          cL.appendChild(middleDot);

          var hms = document.createElement("span");
          hms.innerHTML = `${json["data"][j]["hms"]}`;
          hms.classList.add("hms");
          cL.appendChild(hms);

          var closeBacket = document.createElement("span");
          closeBacket.innerHTML = " ]";
          closeBacket.classList.add("time__sep");
          cL.appendChild(closeBacket);
        }
        {
          var timeZone = document.createElement("span");
          timeZone.classList.add("time__zone");
          timeZone.innerHTML = `${json["data"][j]["timeZone"]}`;
          cL.appendChild(timeZone);

          var utc = document.createElement("span");
          utc.classList.add("utc");
          utc.innerHTML = `${json["data"][j]["utc"]}`;
          cL.appendChild(utc);

          var country = document.createElement("span");
          country.classList.add("country");
          country.innerHTML = `${json["data"][j]["country"]}`;
          cL.appendChild(country);

        }
        var dataSep = document.createElement("span");
        dataSep.classList.add("data__sep");
        dataSep.innerHTML = " | ";
        cL.appendChild(dataSep);
        
        {
          var ip = document.createElement("span");
          ip.classList.add("ip");
          ip.innerHTML = `${json["data"][j]["ip"]}`;
          cL.appendChild(ip);

          var browser = document.createElement("span");
          browser.classList.add("browser");
          browser.innerHTML = `${json["data"][j]["browser"]}`;
          cL.appendChild(browser);

          var os = document.createElement("span");
          os.classList.add("os");
          os.innerHTML = `${json["data"][j]["os"]}`;
          cL.appendChild(os);
        }
      }
    });
};
load();

document.getElementById("refresh").addEventListener("click", () => {
  while(document.getElementById("list").firstChild){
    document.getElementById("list").removeChild(document.getElementById("list").lastChild);
  };
  load();
})
