function getFormData(form) {
    const data = {};
    const elements = form.elements;
    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        if (element.name) {
            data[element.name] = element.value;
        }
    }
    return data;
}

function resetAlert(){
    $("#alertmsg").css("color","red")
    $("#alertmsg").html("")
}

function toAlert(msg,f=false){
    if(f){
        $("#alertmsg").css("color","#36ff2f")
        $("#alertmsg").append("<div>注册成功，你现在可以返回登录页面了</div>")
        $("#finishReg").attr("disabled","true")
    }else{
        $("#alertmsg").append("<div>注册失败："+msg+"</div>")
    }
}

let registerForm = document.getElementById("registerForm");

registerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    var data = getFormData(registerForm);

    resetAlert()

    if(data.steamid == ""){
        toAlert("SteamID不能为空")
        return
    }
    if(data.uemail == ""){
        toAlert("邮箱不能为空")
        return
    }
    if(data.upwd == ""){
        toAlert("密码不能为空")
        return
    }
    if(data.upwdagain == ""){
        toAlert("请再次输入一遍密码")
        return
    }
    if(data.upwd != data.upwdagain){
        toAlert("两次输入的密码不相同")
        return
    }

    $.post("./register.php",data,(json)=>{
        console.log(json)
        if(json["code"]!=200){
            toAlert(json["info"])
            return
        }else{
            setTimeout(function() {
                location.reload();
            }, 500);
        }
    })
})