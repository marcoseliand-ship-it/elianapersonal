const form=document.getElementById("formLogin");

const senha=document.getElementById("senha");

const email=document.getElementById("email");

const tipo=document.getElementById("tipo");

const erro=document.getElementById("erro");

document
.getElementById("mostrarSenha")
.addEventListener("click",()=>{

senha.type=
senha.type==="password"
?
"text"
:
"password";

});

form.addEventListener("submit",(e)=>{

erro.innerHTML="";

if(email.value===""){

e.preventDefault();

erro.innerHTML="Informe seu e-mail.";

return;

}

if(senha.value.length<6){

e.preventDefault();

erro.innerHTML="Senha deve possuir no mínimo 6 caracteres.";

return;

}

if(tipo.value===""){

e.preventDefault();

erro.innerHTML="Selecione o tipo de acesso.";

}

});