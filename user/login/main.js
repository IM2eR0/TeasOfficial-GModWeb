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
    $("#alertmsg").html("")
}

function toAlert(msg){
    $("#alertmsg").append("<div>登录失败："+msg+"</div>")
}

let registerForm = document.getElementById("registerForm");

registerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    var data = getFormData(registerForm);

    resetAlert()

    if(data.uemail == ""){
        toAlert("邮箱不能为空")
        return
    }
    if(data.upwd == ""){
        toAlert("密码不能为空")
        return
    }

    $.post("./register.php",data,(json)=>{
        if(json["code"]!=200){
            toAlert(json["info"])
            return
        }else{
            setTimeout(function() {
                console.log("refresh")
                location.reload();
            }, 500);
        }
    })
})