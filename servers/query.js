var serverlist = new Array();

serverlist[1] = {
    ["servername"]: "CSS连跳服",
    ["serverip"]: "gmod.ltd",
    ["serverport"]: 54005
}

function _reload(f=false){
    var tbody = document.getElementById("serverlist");
    if(f){
        tbody.innerHTML = "";
    }
    for(i=0;i<serverlist.length;i++){
        var data = serverlist[i]
        $.post("./query.php",data,function(json){
            if(json.code == 0){
                var link = data.serverip + ":" + data.serverport
                tbody.innerHTML += `
                <tr>
                    <td>${json.info.HostName}</td>
                    <td>${json.info.ModDesc}</td>
                    <td>${json.info.Map}</td>
                    <td>${json.info.Players} / ${json.info.MaxPlayers}</td>
                </tr>`
            }else{
                tbody.innerHTML += `
                <tr>
                    <td>${data.servername}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>0 / 0</td>
                </tr>`
            }
        })
    }
}
_reload()