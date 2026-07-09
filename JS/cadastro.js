const form=document.getElementById("formCadastro");

const erro=document.getElementById("erro");

form.addEventListener("submit",(e)=>{

erro.innerHTML="";

if(nome.value==""){

e.preventDefault();

erro.innerHTML="Informe seu nome.";

return;

}

if(email.value==""){

e.preventDefault();

erro.innerHTML="Informe o e-mail.";

return;

}

if(telefone.value==""){

e.preventDefault();

erro.innerHTML="Informe o telefone.";

return;

}

if(senha.value.length<6){

e.preventDefault();

erro.innerHTML="A senha deve ter no mínimo 6 caracteres.";

return;

}

});