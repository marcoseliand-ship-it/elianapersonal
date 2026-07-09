console.log("Sistema Eliana Dantas Personal iniciado!");

const botao = document.querySelector(".btn");

botao.addEventListener("mouseover", () => {
    botao.style.transform = "scale(1.05)";
});

botao.addEventListener("mouseout", () => {
    botao.style.transform = "scale(1)";
});