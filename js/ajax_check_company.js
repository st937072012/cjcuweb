var bol=false;

$.ajax({
type:"POST",
url:"ajax/userexist.aspx",
data:"username="+vusername.value,

success:function(msg){

if(msg=="ok"){
showtipex(vusername.id,"<img src='images/ok.gif'/><b><font color='#ffff00'>该用户名可以使用</font></b>",false)
success_function(msg);
}

else{
showtipex(vusername.id,"<img src='images/cancel.gif'/><b><font color='#ffff00'>该用户已被注册</font></b>",false);
vusername.className="bigwrong";
fail_function(msg);
}

}

});



function success_function(info)
{
alert(info);
}
funciont fail_function(info)
{
alert(info);
} 